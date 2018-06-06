<?php

namespace Blogs\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blogs\Http\Requests\CategoryStoreRequest;
use Blogs\Http\Requests\CategoryUpdateRequest;
use Blogs\Http\Controllers\Controller;

use Blogs\Category;

class CategoryController extends Controller
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
        $categories = Category::orderBy('id', 'DESC')->paginate();

        //dd($categories);//esta funcion me permite imprimir en la viste todo el contenido de las variables
        return view('admin.categories.index', compact('categories')); //compact me permite crear un array, ejemp ['categories' => $categories]
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //este metodo muestra el formulario, no lo guarda
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request) // este metodo guarda el formulario
    {
        $category = Category::create($request->all()); //esto retorna contenido masivo, pero en el modulo Category ya estamos verificando que solo pase el name y el slug

        return redirect()->route('categories.edit', $category->id)
            ->with('info', 'Categoría creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::find($id);

        $category->fill($request->all());
        
        return redirect()->route('categories.edit', $category->id)
            ->with('info', 'Categoria actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id)->delete();

        return back()->with('info', 'Eliminado correctamente');
    }
}
