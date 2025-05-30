@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Movie</h2>
    <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $movie->title) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $movie->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Genre</label>
            <select name="genre" class="form-select">
                <option value="Action" {{ $movie->genre === 'Action' ? 'selected' : '' }}>Action</option>
                <option value="Comedy" {{ $movie->genre === 'Comedy' ? 'selected' : '' }}>Comedy</option>
                <option value="Drama" {{ $movie->genre === 'Drama' ? 'selected' : '' }}>Drama</option>
                <option value="Fantasy" {{ $movie->genre === 'Fantasy' ? 'selected' : '' }}>Fantasy</option>
                <option value="Horror" {{ $movie->genre === 'Horror' ? 'selected' : '' }}>Horror</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Release Date</label>
            <input type="date" name="release_date" class="form-control" value="{{ old('release_date', $movie->release_date) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Poster Image</label>
            <input type="file" name="image" class="form-control">
            @if ($movie->image)
                <p class="mt-2">Current: <img src="{{ asset('storage/' . $movie->image) }}" width="100"></p>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update Movie</button>
         <a href="{{ route('movies.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
