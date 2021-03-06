@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header d-flex">
                        Dettagli post {{$post->title}}
                    </div>

                    @if($post->coverImage)
                        <img src="{{ asset('storage/' . $post->coverImage) }}" class="img-fluid" alt="">
                    @else
                        <img src="https://www.logistec.com/wp-content/uploads/2017/12/placeholder.png" alt="">
                    @endif

                    <div class="card-body">
                        {{ $post->content }}

                        <div class="mt-3">
                            @php
                                use Carbon\Carbon;
                                $dateFormat = "d/m/Y (H:i)";
                            @endphp

                            Contenuto: {{ $post->content }}
                            
                            <br>
                            
                            Data creazione: {{ $post->created_at->format($dateFormat) }}
                            
                            <br>
                            
                            Data ultima modifica: 
                            
                            {{ $post->updated_at->format($dateFormat)}}
                            ({{ $post->updated_at->diffForHumans(Carbon::now()) }})
                            
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
                        <a href="{{route('admin.posts.index')}}"><i class="fa-solid fa-arrow-right-to-bracket"></i>Indietro</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection