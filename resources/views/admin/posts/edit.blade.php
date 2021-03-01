@extends('layouts.app')

@section('content')
  <div class="container">
    <h1 class="mt-5">Modifica il post</h1>

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="title">Titolo</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Titolo" value="{{ $post->title }}">
      </div>
      <div class="form-group">
        <label for="subtitle">Sottotitolo</label>
        <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="Sottotitolo" value="{{ $post->subtitle }}">
      </div>
      <div class="form-group">
        <label for="text">Testo</label>
        <textarea class="form-control" name="text" id="text" rows="10">{{ $post->text }}</textarea>
      </div>
      <div class="form-group">
        <label for="img_path">Immagine</label>
        <input type="text" class="form-control" name="img_path" id="img_path" placeholder="Immagine" value="{{ $post->img_path }}">
      </div>
      <div class="form-group">
        <label for="publication_date">Data di pubblicazione</label>
        <input type="date" class="form-control" name="publication_date" id="publication_date" placeholder="Data" value="{{ $post->publication_date }}">
      </div>
      <button type="submit" class="btn btn-primary">Salva</button>
      <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Indietro</a>
    </form>

  </div>
@endsection