<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>CREA IL TUO POST<h1>
<div class="form">
    <form class="" action="{{route('posts.store')}}" method="POST">
    <input type="text" name="title" placeholder="Titolo" value="">
    <input type="text" name="body" placeholder="Corpo dell'articolo" value="" cols="20" rows="5">
    <button type="submit" name="button">Inserisci</button>
    @csrf
    @method('POST')
  </form>
</div>  
</body>
</html>