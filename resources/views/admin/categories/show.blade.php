@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-heading">
                        Ver Categoría
                    </div>

                    <div class="card-body">
                        <p><strong>Nombre</strong>      {{ $category->name }}</p>
                        <p><strong>Slug</strong>        {{ $category->slug }}</p>
                        <p><strong>Contenido</strong>   {{ $category->body }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
