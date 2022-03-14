@extends('layout.app')

@section('content')
    <div>
        @foreach ( $posts as $post )
            <li class="list-group-item">{{$post->title}}</li>
        @endforeach
    </div>    
@endsection