@extends('layouts.app')
@section('content')
<div>
  <a class="btn btn-success mb-3" href="{{route('admin.posts.create')}}">Crea un nuovo post</a>
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titolo</th>
                    <th>ID USER</th>
                    <th>Creato il</th>
                    <th>Aggiornato il</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->user_id}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
                    <td><a class="btn btn-success" href="{{route('admin.posts.show', $post->slug)}}">Mostra il Post</a> </td>
                    <td><a class="btn btn-primary" href="{{route('admin.posts.edit', $post->slug)}}">Modifica il Post</a> </td>
                    <td>
                    <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Cancella il Post</button>  
                    </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
@endsection
