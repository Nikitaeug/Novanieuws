<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Commentaar;
use App\Models\Tag;
use App\Models\Nieuws;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NieuwsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $news = Nieuws::all();
    // dd($news->first()->id);
    return view('nieuws.index', compact('news'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $tags = Tag::all();
    $categories = Categorie::all();

    return view('nieuws.create', compact('tags', 'categories'));
}

    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category' => 'required|integer',
    ],
    [
        'title.required' => 'Title is required',
        'content.required' => 'Content is required',
        'category.required' => 'Category is required',
    ]);

        $nieuws = new Nieuws();
        $nieuws->user_id = auth()->id();
        $nieuws->title = $request->title;
        $nieuws->description = $request->content;
        $nieuws->category_id = $request->category;

        $nieuws->save();

        if ($request->tags) {
            $nieuws->tags()->attach($request->tags);
        }
        

        return redirect()->route('nieuws.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $news = Nieuws::findOrFail($id);
        $comments = Commentaar::where('news_id', $id)->get();
        
        return view('nieuws.show', compact('news', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $nieuws = Nieuws::find($id);
    $tags = Tag::all();
    $categories = Categorie::all();

    if ($nieuws) {
        return view('nieuws.edit')->with('news', $nieuws)->with('tags', $tags)->with('categories', $categories);
    }

    return redirect()->route('nieuws.index')->with('error', 'News not found');
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'categories' => 'required|integer',
        ],
        [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'categories.required' => 'Category is required',
        ]);

        $nieuws = Nieuws::find($id);
    
        if ($nieuws) {
            
            $nieuws->user_id = auth()->id();
            $nieuws->title = $request->title;
            $nieuws->description = $request->description;
            $nieuws->category_id = $request->categories;
            $nieuws->save();
            
            if ($request->tags) {
                $nieuws->tags()->sync($request->tags);
            }
            return redirect()->route('nieuws.index')->with('success', 'News updated successfully');
        }
    
        return redirect()->route('nieuws.index')->with('error', 'News not found');
    }
    public function destroy($id)
    {
        $news = Nieuws::find($id);
    
        if ($news) {
            // Detach all associated tags before deleting the news record
            $news->tags()->detach();
    
            $news->delete();
            return redirect()->route('nieuws.index')->with('success', 'News deleted successfully');
        }
    
        return redirect()->route('nieuws.index')->with('error', 'News not found');
    }

public function manage()
{
    // Get the currently authenticated user's news
    $news = auth()->user()->nieuws;

    return view('nieuws.manage', compact('news'));
}
}
