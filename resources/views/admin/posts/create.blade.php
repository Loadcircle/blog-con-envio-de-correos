@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-heading">
                        Crear Entrada
                    </div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'posts.store', 'files' => true]) !!} <!-- hay que decirle files true para que laravel permita archivos -->
                        
                            @include('admin.posts.partials.form')
                            
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
