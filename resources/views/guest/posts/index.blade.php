@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
          @foreach ($posts as $post)
              <div class="card mt-5 mb-5">
                <h2>{{$post->title}}</h2>
                <h4>Autore: {{$post->user->name}}</h4>
                <div>
                  {{$post->body}}
                </div>
                    <a href="{{route('posts.show', $post->slug)}}">Vai all'articolo</a>
                </div>
          @endforeach
        </div>
      </div>
    </div>
@endsection