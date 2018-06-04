@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="col-md-12 col-md-offset-2">
          <h1>{{ $post->name }}</h1>

          <div class="panel panel-default">
            <div class="panel-heading">
                Categoría
                <a href="{{ route('category', $post->category->slug) }}">{{ $post->category->name }}</a>
            </div>
            <div class="panel-body">
                @if($post->file)
                <img src="{{ $post->file }}" class="img-fluid" alt="">
                @endif
                {{ $post->excerpt }}
                <hr>
                {!! $post->body !!}  {{-- los simbolos !! indican que el texto es un codigo html --}} 
                <hr>
                Etiquetas 
                @foreach($post->tags as $tag)
                <a href="{{ route('tag', $tag->slug) }}">
                    {{ $tag->name }}
                </a>
                @endforeach
            </div>
          </div>
      </div>
  </div>
@endsection