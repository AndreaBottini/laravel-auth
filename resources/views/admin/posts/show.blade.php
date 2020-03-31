@extends('layouts.app')
@section('content')
<div>
  <a class="btn btn-danger mb-3" href="{{route('admin.posts.index')}}">Pagina Inziale</a>
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titolo</th>
                    <th>Corpo Articolo</th>
                    <th>ID USER</th>
                    <th>Creato il</th>
                    <th>Aggiornato il</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->body}}</td>
                    <td>{{$post->user_id}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
                </tr>
            </tbody>
        </table>
@endsection