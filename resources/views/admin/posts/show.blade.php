@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex">
                        Dettagli post {{$post->title}}
                    </div>

                    <div class="card-body">
                        {{ $post->content }}

                        <div class="mt-3">
                            Contenuto: {{ $post->content }}
                            <br>
                            Data creazione: {{ $post->created_at }}
                            <br>
                            Data ultima modifica: {{ $post->updated_at }}
                            <br>
                            Slug: {{ $post->slug }}
                            <br>
                            {{-- Utente: {{ $post->user->name }} --}}
                            <br>
                            @if($post->category !== null)
                                Category: {{ $post->category->code }}
                            @endif

                            <br>

                            @if($post->tags !== null)
                                Tags: 
                                @foreach($post->tags as $tag)
                                    #{{ $tag->name }}
                                @endforeach
                            @endif
                        </div>
                        
                    </div>

                    <form class="ms-auto" action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <a class="btn btn-link" href="{{route('admin.posts.edit', $post->id)}}">Modifica</a>
                        <button class="btn btn-link" type="submit">Elimina</button>
                        <a href="{{route('admin.posts.index')}}">Annulla</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection