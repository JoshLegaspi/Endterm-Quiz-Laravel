<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
   public function index(Request $request)
{
    $query = Movie::query();

    if ($request->search) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->genre) {
        $query->where('genre', $request->genre);
    }

    $sort = $request->get('sort', 'title');
    $direction = $request->get('direction', 'asc');

    $movies = $query->orderBy($sort, $direction)->paginate(5);

    return view('movies.index', compact('movies', 'sort', 'direction'));
}

    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        return view('movies.create');
    }

    public function store(Request $request)
{
    $request->validate([
       'title' => 'required|string|max:255',
    'description' => 'required|string',
    'genre' => 'required|string',
    'release_date' => 'required|date|before_or_equal:today',
    'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posters', 'public');
    }

    Movie::create([
        'title' => $request->title,
        'description' => $request->description,
        'genre' => $request->genre,
        'release_date' => $request->release_date,
        'image' => $imagePath,
    ]);

    return redirect()->route('dashboard')->with('success', 'Movie added successfully!');
}
public function edit(Movie $movie)
{
    return view('movies.edit', compact('movie'));
}
public function update(Request $request, Movie $movie)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'genre' => 'required|string',
        'release_date' => 'required|date|before_or_equal:today',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['title', 'description', 'genre', 'release_date']);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('posters', 'public');
    }

    $movie->update($data);

    return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
}
public function destroy(Movie $movie)
{
    if ($movie->image && \Storage::disk('public')->exists($movie->image)) {
        \Storage::disk('public')->delete($movie->image);
    }

    $movie->delete();

    return redirect()->route('movies.index')->with('success', 'Movie deleted.');
}

}
