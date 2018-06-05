<?php

namespace Blogs\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blogs\Http\Requests\TagStoreRequest;
use Blogs\Http\Requests\TagUpdateRequest;
use Blogs\Http\Controllers\Controller;

use Blogs\Tag;

class TagController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); // esto pide que para entrar este autorizado, o sea logeado
    }                              // esto podria agregarse en cada funcion pero al colocarse en constructor protege todo el cotnrolador
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('id', 'DESC')->paginate();

        //dd($tags);//esta funcion me permite imprimir en la viste todo el contenido de las variables
        return view('admin.tags.index', compact('tags')); //compact me permite crear un array, ejemp ['tags' => $tags]
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //este metodo muestra el formulario, no lo guarda
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagStoreRequest $request) // este metodo guarda el formulario
    {
        $tag = Tag::create($request->all()); //esto retorna contenido masivo, pero en el modulo tag ya estamos verificando que solo pase el name y el slug

        return redirect()->route('tags.edit', $tag->id)
            ->with('info', 'Etiqueta creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);

        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagUpdateRequest $request, $id)
    {
        $tag = Tag::find($id);

        $tag->fill($request->all());
        
        return redirect()->route('tags.edit', $tag->id)
            ->with('info', 'Etiqueta actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id)->delete();

        return back()->with('info', 'Eliminado correctamente');
    }
}
