@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="col-md-12 col-md-offset-2">
          <h1>Lista de Artículos</h1>
          @foreach($posts as $post)
          <div class="panel panel-default">
            <div class="panel-heading">
                {{ $post->name }}
            </div>
            <div class="panel-body">
                @if($post->file)
                <img src="{{ $post->file }}" class="img-fluid" alt="">
                @endif
                {{ $post->excerpt }}
                <a href="{{ route('post', $post->slug) }}" class="pull-right">Leer más</a>
            </div>
          </div>
          <hr>
          @endforeach
          {{ $posts->render() }}
      </div>
  </div>
@endsection