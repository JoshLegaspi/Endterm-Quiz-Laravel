@extends('layouts.app')

@section('content')
<h2>Add New Movie</h2>
<form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
    <label>Genre</label>
    <select name="genre" class="form-select" required>
        <option value="">Select Genre</option>
        <option value="Action">Action</option>
        <option value="Comedy">Comedy</option>
        <option value="Drama">Drama</option>
        <option value="Fantasy">Fantasy</option>
        <option value="Horror">Horror</option>
    </select>
</div>

    <div class="mb-3">
    <label for="release_date" class="form-label">Release Date</label>
    <input type="date" name="release_date" id="release_date" class="form-control" value="{{ old('release_date', $movie->release_date ?? '') }}">
    @error('release_date')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
    <div class="mb-3">
        <label>Movie Poster</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Add Movie</button>
</form>
@endsection
