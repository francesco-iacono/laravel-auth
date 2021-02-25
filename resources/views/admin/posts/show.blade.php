@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mt-5">Dettaglio post: <span class="text-secondary"> {{ $post->title }}</span></h1>
  <table class="table table-light table-striped table-bordered">
    @foreach ($post->getAttributes() as $key => $value)
    <tr>
      <td><strong>{{ $key }}</strong></td>
      <td>{{ $value }}</td>
    </tr>
    @endforeach
  </table>
  </table>
  <div class="text-right">
    <a href="{{ route('admin.posts.index') }}" class="btn btn-lg btn-primary">Torna ai post</a>
  </div>
</div>
@endsection