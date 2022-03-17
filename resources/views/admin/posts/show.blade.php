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
                        <a class="btn btn-link text-dark" href="{{route('admin.posts.edit', $post->id)}}"><i class="fa-solid fa-pen"></i>Modifica</a>
                        <button class="btn btn-link text-danger" type="submit"><i class="fa-solid fa-trash-can"></i>Elimina</button>
                        <a href="{{route('admin.posts.index')}}"><i class="fa-solid fa-arrow-right-to-bracket"></i>Annulla</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection