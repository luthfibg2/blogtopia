<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends Controller
{
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
    public function show($category, $type)
    {
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
        
        // Load view dengan data yang sesuai
        return view('content', [
            'currentCategory' => $category,
            'currentType' => $type
        ]);
    }
}
