{{ Form::hidden('user_id', auth()->user()->id) }}
<div class="form-group">
        {{ Form::label('category_id', 'Categorías') }}
        {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('name', 'Nombre de la Entrada') }}
    {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) }}
</div>
<div class="form-group">
        {{ Form::label('slug', 'URL Amigable') }}
        {{ Form::text('slug', null, ['class' => 'form-control', 'id' => 'slug']) }}
</div>
<div class="form-group">
        {{ Form::label('body', 'Descripción') }}
        {{ Form::textarea('body', null, ['class' => 'form-control', 'id' => 'body']) }}
</div>
<div class="form-group">
        {{ Form::label('excerpt', 'Extracto') }}
        {{ Form::textarea('excerpt', null, ['class' => 'form-control', 'row' => '2']) }}
</div>
<div class="form-group">
        {{ Form::label('tags', 'Etiquetas') }}
        <div>
            @foreach ($tags as $tag)
                <label>
                    {{ Form::checkbox('tags[]', $tag->id) }} {{ $tag->name }}
                </label>
            @endforeach
        </div>
</div>
<div class="form-group">
    {{ Form::label('estatus', 'Estado') }}
    <label>
        {{ Form::radio('status', 'PUBLISHED') }} Publicado
    </label>
    <label>
            {{ Form::radio('status', 'DRAFT') }} Borrador
    </label>
        {{-- se crean los radio dentro de los labels para que se pueda hacer click en el texto para seleccionar el radio --}}
</div>
<div class="form-group">
        {{ Form::label('image', 'Imagen') }}
        {{ Form::file('image') }}
</div>
<div class="form-group">
        {{ Form::submit('Guardar', ['class'=>'btn btn-sm btn-primary']) }}
</div>
@section('scripts')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        //Script para convertir el texto de name a slug (url)
        document.addEventListener("DOMContentLoaded", function(e) {
            var name = document.getElementById('name'),
                slug = document.getElementById('slug');

            name.onkeyup = function() {
            slug.value = string_to_slug(name.value);
            }
        });
        function string_to_slug (str) {
                str = str.replace(/^\s+|\s+$/g, ''); // trim
                str = str.toLowerCase();
                // remove accents, swap ñ for n, etc
                var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                var to   = "aaaaeeeeiiiioooouuuunc------";
                for (var i=0, l=from.length ; i<l ; i++) {
                    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }
                str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-') // collapse whitespace and replace by -
                    .replace(/-+/g, '-'); // collapse dashes

                return str;
        }
        //Script para convertir el texto de name a slug (url)

        CKEDITOR.replace('body');
        /*ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );*/

    </script>
@endsection﻿