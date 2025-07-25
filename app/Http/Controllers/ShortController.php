<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Short;
use Illuminate\Http\Request;

class ShortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_shorts = Short::all();
        $my_shorts = Short::where('user_id', auth()->user()->id)->get();

        return view('content', compact('all_shorts', 'my_shorts'))->with('currentCategory', 'all')->with('currentType', 'short');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        return view('pages.create-content', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Short $short)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Short $short)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Short $short)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Short $short)
    {
        //
    }
}
