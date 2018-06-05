@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-heading">
                        Crear Etiqueta
                    </div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'tags.store']) !!}
                        
                            @include('admin.tags.partials.form')
                            
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
