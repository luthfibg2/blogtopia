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

    public function store(StoreRequest $request, $category, $type)
    {
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
}
