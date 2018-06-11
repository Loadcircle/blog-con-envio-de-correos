<div class="form-group">
    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nombre']) }}
</div>
<div class="form-group">
    {{ Form::text('apellido', null, ['class' => 'form-control', 'id' => 'apellido', 'placeholder' => 'Apellido']) }}
</div>
<div class="form-group">
    {{ Form::tel('telefono', null, ['class' => 'form-control', 'id' => 'telefono', 'placeholder' => 'Telefono']) }}
</div>
<div class="form-group">
    {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Correo']) }}
</div>
<div class="form-group">
    {{ Form::textarea('mensaje', null, ['class' => 'form-control', 'id' => 'mensaje', 'placeholder' => 'Mensaje']) }}
</div>
<div class="form-group">
        {{ Form::submit('Enviar', ['class'=>'btn btn-sm btn-primary']) }}
</div>