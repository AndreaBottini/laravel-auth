@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
      <form action="{{route('admin.posts.store')}}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
          <label for="title">Title</label>
          <input class="form-control" type="text" name="title">
        </div>
        <div class="form-group">
          <label for="body">Body</label>
          <textarea class="form-control" name="body" id="body" cols="60" rows="5">
          </textarea>
        </div> 
      
        <div class="form-group">
          <label for="tags">Tags</label>
        @foreach ($tags as $tag)
        <div>
          <span>{{$tag->name}}</span>
          <input type="checkbox" name="tags[]" value="{{$tag->id}}">
        </div>
        @endforeach
        </div>
        <button class="btn btn-success" type="submit">Salva le Modifiche</button>
      </form>
    </div>  
</div>  
@endsection