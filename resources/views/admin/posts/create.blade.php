@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('admin.posts.store') }}">
        @csrf
        <div class="form-group mb-3">
            <label class="mb-3">Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Inserisci il titolo">
        </div>
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="form-group mb-3">
            <label class="mb-3">Contenuto</label>
            <textarea name="content" rows="10" class="form-control @error('content') is-invalid @enderror"
                placeholder="Inserisci il contenuto" required>{{ old('content') }}</textarea>
        </div>
        @error('content')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Annulla</a>
        <button type="submit" class="btn btn-primary">Crea</button>
    </form>
</div>

@endsection