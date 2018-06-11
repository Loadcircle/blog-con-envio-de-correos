@extends('layouts.app')
@section('content')
    <div class="text-center">
        <h1>Bienvenido al formulario de contacto</h1>
        <span>Aca puede dejarnos un mensaje</span>
        {!! Form::open(['route' => 'enviar', 'method' => 'post']) !!}
                        
                @include('partials.form')
                            
        {!! Form::close() !!}
    </div>
@endsection