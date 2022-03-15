@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.posts.update', $post->id) }}">
        @csrf
        @method('patch')

        <div class="form-group mb-3">
            <label class="mb-3">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}" placeholder="Inserisci il titolo">
        </div>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="form-group mb-3">
            <label class="mb-3">Contenuto</label>
            <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror"
                placeholder="Inserisci il contenuto" required>{{ old('content', $post->content) }}</textarea>   
        </div>

        @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-secondary">Annulla</a>
        <button type="submit" class="btn btn-primary">Clicca per modificare</button>
    </form>
</div>
@endsection
