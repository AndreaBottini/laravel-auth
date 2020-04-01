@extends('layouts.app')
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-12">
            <a class="btn btn-danger mb-3" href="{{route('posts.index')}}">Pagina Inziale</a>
          <h2>{{$post->title}}</h2>
          <h4>Autore Articolo: {{$post->user->name}}</h4>
          <div>
            {{$post->body}}
          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-12">
          <h3>Commenti</h3>
          @foreach ($post->comments as $comment)
              <h4>Commento all'articolo di: {{$comment->name}}</h4>
              <div>
                {{$comment->body}}
              </div>
          @endforeach  
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <form action="{{route('comments.store')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
              <label for="title">Titolo</label>
              <input class="form-control" type="text" name="title">
            </div>
            <div class="form-group">
              <label for="body">Commento</label>
              <textarea class="form-control"  name="body" id="body" cols="5" rows="5"></textarea>
            </div>
            <div class="form-group">
              <label for="name">Il tuo Nome</label>
              <input class="form-control"  type="text" name="name">
            </div>
            <div class="form-group">
              <label for="email">La tua mail</label>
              <input class="form-control"  type="text" name="email">
            </div>
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <button class="btn btn-primary" type="submit">Invia</button>
          </form>
        </div>
      </div>
    </div>
@endsection
          