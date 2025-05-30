@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h2 class="mb-0">Movies</h2>
        @auth
        <div>
            <span class="me-3">Hi, {{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class="btn btn-outline-danger btn-sm">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </div>
        @endauth
    </div>

    @if (Auth::user()->role === 'admin')
    <div class="mb-4">
        <a href="{{ route('movies.create') }}" class="btn btn-primary">Add New Movie</a>
    </div>
    @endif

    <form method="GET" class="row gy-2 gx-3 mb-4">
        <div class="col-12 col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search title...">
        </div>
        <div class="col-6 col-md-3">
            <select name="genre" class="form-select">
                <option value="">All Genres</option>
                <option value="Action" {{ request('genre') === 'Action' ? 'selected' : '' }}>Action</option>
                <option value="Comedy" {{ request('genre') === 'Comedy' ? 'selected' : '' }}>Comedy</option>
                <option value="Drama" {{ request('genre') === 'Drama' ? 'selected' : '' }}>Drama</option>
                <option value="Fantasy" {{ request('genre') === 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                <option value="Horror" {{ request('genre') === 'Horror' ? 'selected' : '' }}>Horror</option>
            </select>
        </div>
        <div class="col-6 col-md-2">
            <select name="sort" class="form-select">
                <option value="title" {{ request('sort') === 'title' ? 'selected' : '' }}>Title</option>
                <option value="release_date" {{ request('sort') === 'release_date' ? 'selected' : '' }}>Release Date</option>
            </select>
        </div>
        <div class="col-6 col-md-2">
            <select name="direction" class="form-select">
                <option value="asc" {{ request('direction') === 'asc' ? 'selected' : '' }}>ASC</option>
                <option value="desc" {{ request('direction') === 'desc' ? 'selected' : '' }}>DESC</option>
            </select>
        </div>
        <div class="col-6 col-md-1 d-grid">
            <button type="submit" class="btn btn-secondary">Go</button>
        </div>
    </form>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($movies as $movie)
        <div class="col">
            <div class="card h-100 shadow-sm">
                @if ($movie->image)
                <img src="{{ asset('storage/' . $movie->image) }}" class="card-img-top" alt="{{ $movie->title }} poster" style="height: 300px; object-fit: cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $movie->title }}</h5>
                    <p class="card-text flex-grow-1">{{ Str::limit($movie->description, 140) }}</p>
                    <p class="mb-1"><small class="text-muted">Genre: {{ $movie->genre }}</small></p>
                    <p><small class="text-muted">Release Date: {{ $movie->release_date }}</small></p>

                    @if (Auth::user()->role === 'admin')
                    <div class="mt-auto d-flex gap-2">
                        <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-sm btn-warning flex-grow-1">Edit</a>
                        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this movie?');" class="flex-grow-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $movies->appends(request()->query())->links() }}
    </div>
</div>
@endsection
