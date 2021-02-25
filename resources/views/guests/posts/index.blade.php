@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">

      @foreach ($posts as $post)

        <div class="col-4 my-3 d-flex align-content-stretch">
          <div class="card">
            <img class="card-img-top" src="{{ $post->img_path }}" alt="{{ $post->title }}">
            <div class="card-body">
              <h5 class="card-title">{{ $post->title }}</h5>
              <small>{{ $post->user->name }}</small>
              <div class="text-left my-3">
              </div>
              <a href="#" class="btn btn-primary">Leggi</a>
            </div>
          </div>
        </div>
          
      @endforeach

    </div>
  </div>
@endsection