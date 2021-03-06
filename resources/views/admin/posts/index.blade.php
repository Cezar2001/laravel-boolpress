@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex">
                        Lista dei post

                        <a class="ms-auto" href="{{ route('admin.posts.create') }}"><i class="fa-solid fa-plus"></i>Aggiungi</a>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            @php
                                use Carbon\Carbon;
                                $dateFormat = "d/m/Y";
                            @endphp

                            @foreach ($posts as $post)

                                <li class="list-group-item">{{$post->title}}
                                    
                                    <a class="ms-3 me-3" href="{{ route('admin.posts.show', $post->slug) }}" title="Visualizza"><i class="fa-solid fa-eye"></i></a>
                                    
                                    <a class="text-dark" href="{{route('admin.posts.edit', $post->id)}}" title="Modifica"><i class="fa-solid fa-pen"></i></a>
                                    
                                    <span class="d-flex">
                                        Modificato: 
                                        {{ $post->updated_at->diffForHumans(Carbon::now()) }}
                                    </span>

                                    <span class="d-flex">
                                        Publicato: 
                                        {{ $post->created_at->format($dateFormat) }}
                                    </span>
                                        
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection