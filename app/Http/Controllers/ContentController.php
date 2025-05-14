<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Mech;
use App\Models\Refs;
use App\Models\Flash;
use App\Models\Genre;
use App\Models\Lyric;
use App\Models\Short;
use App\Models\Series;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreRequest;
use Illuminate\Support\Facades\Log;

class ContentController extends Controller
{
    /**
     * Display content based on category and type
     */
    public function index($category, $type)
    {
        $contents = Short::all();
        $my_contents = Short::where('author_id', Auth::id())->get();

        // Validasi kategori
        if (!in_array($category, ['all', 'private', 'favorite'])) {
            abort(404);
        }
        
        // Validasi tipe
        if (!in_array($type, ['latest', 'flash', 'short', 'series', 'lyric', 'mech', 'refs'])) {
            abort(404);
        }
        
        // Validasi kombinasi kategori dan tipe
        if ($category === 'favorite' && in_array($type, ['latest', 'flash', 'refs'])) {
            // abort(404, 'Kombinasi kategori dan tipe tidak tersedia');
            return redirect()->route('content.type', ['category' => 'favorite', 'type' => 'short']);
        }

        // Ambil konten berdasarkan tipe
        switch ($type) {
            case 'latest':
                // Mengambil data terbaru dari semua model dan menggabungkannya
                $contents = collect()
                    ->merge(Short::filterShort(request(['search', 'genre']))->get())
                    ->merge(Flash::latest()->get())
                    ->merge(Series::latest()->get())
                    ->merge(Lyric::latest()->get())
                    ->merge(Mech::latest()->get())
                    ->merge(Refs::latest()->get())
                    ->sortByDesc('created_at'); // Urutkan berdasarkan created_at terbaru
                break;
            case 'short':
                $contents = Short::filterShort(request(['search', 'genre']))->latest()->get();
                break;
            case 'flash':
                $contents = Flash::all();
                break;
            case 'series':
                $contents = Series::all();
                break;
            case 'lyric':
                $contents = Lyric::all();
                break;
            case 'mech':
                $contents = Mech::all();
                break;
            case 'refs':
                $contents = Refs::all();
                break;
            // Tambahkan case lain untuk tipe lainnya
            default:
                $contents = collect(); // Koleksi kosong
        }
        
        // Load view dengan data yang sesuai
        return view('content', [
            'currentCategory' => $category,
            'currentType' => $type,
            'contents' => $contents,
            'myContents' => $my_contents,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($category, $type)
    {
        $genres = Genre::all();
        return view('pages.create-content', compact('genres', 'category', 'type'));
    }
    
    /**
     * Display the homepage with redirect to default category and type
     */
    public function home()
    {
        return redirect()->route('content.type', ['category' => 'all', 'type' => 'latest']);
    }

    /**
     * Display the main category page with redirect to default type
     */
    public function category($category)
    {
        // Validasi kategori
        if (!in_array($category, ['all', 'private', 'favorite'])) {
            abort(404);
        }
        
        // Redirect ke tipe default untuk kategori
        return redirect()->route('content.type', [
            'category' => $category, 
            'type' => 'latest'
        ]);
    }

    /**
     * Display content based on category and type
     */
    public function show($category, $type, $slug)
    {
        // Validasi tipe konten
        if (!in_array($type, ['short', 'flash', 'series', 'lyric', 'mech', 'refs'])) {
            abort(404);
        }

        // Cari konten berdasarkan slug
        $model = 'App\\Models\\' . Str::studly($type);
        $content = $model::where('slug', $slug)->firstOrFail();

        return view('pages.read', [
            'currentCategory' => $category,
            'currentType' => $type,
            'content' => $content,
        ]);
    }

    public function store(Request $request, $category, $type)
    {
        $validated = null;
        if ($type === 'flash') {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|min:10',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
            ]);

            DB::beginTransaction();
            try {
                $imageUrl = null;

                if ($request->hasFile('image')) {
                    // inisiasi firebase storage
                    $firebaseStorage = (new Factory)->withServiceAccount(config('firebase.credentials'))->createStorage();

                    $bucket = $firebaseStorage->getBucket(config('firebase.bucket'));

                    // generate unique filename
                    $filename = Str::random(20) . '.' . $request->file('image')->getClientOriginalExtension();

                    // konten file
                    $fileContents = file_get_contents($request->file('image')->getRealPath());

                    // path di Firebase Storage
                    $storagePath = 'blogtopia/' . $filename;

                    // upload file ke Firebase Storage
                    $bucket->upload($fileContents, [
                        'name' => $storagePath,
                        'predefinedACL' => 'publicRead',
                    ]);

                    // dapatkan URL gambar
                    $expiresAt = new \DateTime('+3 year');
                    $imageUrl = $bucket->object($storagePath)->signedUrl($expiresAt);
                }

                $model = new Flash();
                $model->title = $validated['title'];
                $model->description = $validated['description'];
                $model->image_url = $imageUrl;
                $model->save();

                DB::commit();

                return redirect()->route('content.type', ['category' => $category, 'type' => 'flash'])->with('success', 'Flash berhasil di unggah');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->with('error', 'Terjadi kesalahan saat mengunggah flash: ' . $e->getMessage())->withInput();
            }
        } else if ($type === 'short') {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'read_in_minutes' => 'required|integer',
                'genre' => 'required|exists:genres,id',
                'content' => 'required|string|min:10',
            ]);
        }

        try {
            // generate slug
            $slug = Str::slug($request->title);

            if (Short::where('slug', $slug)->exists()) {
                $slug = $slug . '-' . time();
            }

            if ($type === 'short') {
                $short = Short::create([
                    'title' => $request->title,
                    'slug' => $slug,
                    'read_in_minutes' => $request->read_in_minutes,
                    'author_id' => Auth::id(),
                    'genre_id' => $request->genre,
                    'content' => $request->content
                ]);

                Log::info('Short created with slug: ' . $short->slug);
                Log::info('Received request data:', [
                    'title' => $request->title,
                    'slug' => $slug,
                    'read_in_minutes' => $request->read_in_minutes,
                    'author_id' => Auth::id(),
                    'genre_id' => $request->genre,
                    'content' => $request->content
                ]);

                return redirect()->route('content.type', ['category' => $category, 'type' => $type])
                    ->with('success', 'Short created successfully');
            }

            return back()->with('error', 'Invalid type');
        } catch (\Exception $e) {
            Log::error('Error creating short: ' . $e->getMessage());
            return back()->with('error', 'Failed to create short');
        }
    }

    /**
     * Form untuk mengedit data
    */
    public function edit($slug, $type)
    {
        if ($type === 'flash') {
            $flash = Flash::findOrFail($slug);
            return view('pages.edit-content', compact('flash'));
        }
    }

    /**
    * Update data
    */

    public function update(Request $request, $id, $category, $type) {
        if ($type === 'flash') {
            // validasi input
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:5000'
            ]);

            DB::beginTransaction();

            try {
                $model = Flash::findOrFail($id);

                // jika ada gambar baru
                if($request->hasFile('image')) {
                    // inisiasi firebase storage
                    $firebaseStorage = (new Factory)->withServiceAccount(config('firebase.projects.app.credentials'))->createStorage();

                    $bucket = $firebaseStorage->getBucket();

                    // hapus gambar lama jika ada
                    if ($model->image_url) {
                        try {
                            // extract path dari url
                            $path = parse_url($model->image_url, PHP_URL_PATH);
                            $path = ltrim($path, '/');
                            $path = explode('/', $path);
                            $path = implode('/', array_slice($path, 2)); // Abaikan nama bucket dan 'o'

                            // hapus file lama
                            $bucket->object($path)->delete();
                        } catch (\Exception $e) {
                            // lanjutkan meskipun hapus file lama gagal
                        }
                    }

                    // generate unique filename
                    $filename = Str::random(20) . '.' . $request->file('image')->getClientOriginalExtension();

                    // konten file
                    $fileContents = file_get_contents($request->file('image')->getRealPath());

                    // path di firebase storage
                    $storagePath = 'blogtopia/' . $filename;

                    // Upload file ke firebase storage
                    $bucket->upload($fileContents, [
                        'name' => $storagePath,
                        'predefinedAcl' => 'publicRead'
                    ]);

                    // get image url
                    $expiresAt = new \DateTime('2028-01-01');
                    $imageUrl = $bucket->object($storagePath)->signedUrl($expiresAt);

                    // update URL gambar
                    $model->image_url = $imageUrl;
                }
                // update field lainnya
                $model->title = $validated['title'];
                $model->description = $validated['description'];

                $model->save();

                DB::commit();

                return redirect()->route('content.type', ['category' => $category, 'type' => 'flash'])->with('success', 'Flash berhasil diperbarui');
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withErrors('Terjadi kesalahan update: ' . $e->getMessage())->withInput();
            }
        }
    }

    /**
     * Hapus konten
     */

    public function destroy($id, $category, $type) {
        DB::beginTransaction();

        if ($type === 'flash') {
            try {
                $model = Flash::findOrFail($id);

                // hapus gambar dari firebase jika ada
                if($model->image_url) {
                    try {
                        // inisiasi firebase storage
                        $firebaseStorage = (new Factory)->withServiceAccount(config('firebase.credentials'))->createStorage();

                        $bucket = $firebaseStorage->getBucket();

                        // ekstrak path dari url
                        $path = parse_url($model->image_url, PHP_URL_PATH);
                        $path = ltrim($path, '/');
                        $path = explode('/', $path);
                        $path = implode('/', array_slice($path, 2));

                        // hapus file
                        $bucket->object($path)->delete();
                    } catch (\Exception $e) {
                        // lanjutkan meskipun hapus file gagal
                    }
                }

                $model->delete();
                DB::commit();

                return redirect()->route('content.type', ['category' => $category, 'type' => 'flash'])->with('success', 'Flash berhasil dihapus');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->withErrors('Terjadi kesalahan menghapus: ' . $e->getMessage());
            }
        }
    }
}
