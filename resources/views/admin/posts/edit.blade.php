@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.posts.update', $post->id) }}">
        @csrf
        @method('patch')

        <div class="form-group mb-3">
            <label class="mb-3">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}" placeholder="Inserisci il titolo">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label class="mb-3">Immagine</label>
            <input type="file" class="form-control @error('coverImage') is-invalid @enderror" name="coverImage" placeholder="Inserisci un'immagine" required>
            @error('coverImage')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label class="mb-3">Contenuto</label>
            <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror"
                placeholder="Inserisci il contenuto" required>{{ old('content', $post->content) }}</textarea>                  
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Categoria</label>
            <select name="category_id" class="form-select">
                <option value="">nessuna categoria</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if ($post->category_id === $category->id) selected @endif>
                        {{ $category->code }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tags</label><br>
            @foreach ($tags as $tag)
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                  id="tag_{{ $tag->id }}" name="tags[]" {{ $post->tags->contains($tag) ? 'checked' : '' }}>
                <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
              </div>
            @endforeach

            @error('tags')
              <div class="text-red">{{ $message }}</div>
            @enderror
        </div>


        <a href="{{ route('admin.posts.show', $post->slug) }}" class="btn btn-secondary">Annulla</a>
        <button type="submit" class="btn btn-primary">Clicca per modificare</button>
    </form>
</div>
@endsection
