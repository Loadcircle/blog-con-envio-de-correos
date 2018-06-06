@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-heading">
                        Ver Entrada
                    </div>

                    <div class="card-body">
                        <p><strong>Nombre</strong>      {{ $post->name }}</p>
                        <p><strong>Slug</strong>        {{ $post->slug }}</p>
                        <p><strong>Contenido</strong>   {{ $post->body }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
