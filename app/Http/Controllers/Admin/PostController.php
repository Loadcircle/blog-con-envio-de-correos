<?php

namespace Blogs\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blogs\Http\Requests\PostStoreRequest;
use Blogs\Http\Requests\PostUpdateRequest;
use Blogs\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage; // necesaria para guardar archivos

use Blogs\Post;
use Blogs\Category;
use Blogs\Tag;

class PostController extends Controller
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
        $posts = Post::orderBy('id', 'DESC')
        ->where('user_id', auth()->user()->id)
        ->paginate();

        //dd($posts);//esta funcion me permite imprimir en la viste todo el contenido de las variables
        return view('admin.posts.index', compact('posts')); //compact me permite crear un array, ejemp ['posts' => $posts]
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //este metodo muestra el formulario, no lo guarda
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags = Tag::orderBy('name', 'ASC')->get();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request) // este metodo guarda el formulario
    {
        $post = Post::create($request->all()); //esto retorna contenido masivo, pero en el modulo Post ya estamos verificando que solo pase el name y el slug

        //image
        if($request->file('image')){ //esta condicion verifica en el formulario si se ha enviado un archivo

            $path = Storage::disk('public')//almacenar en el disco public que busca en filesystems.php en config
                ->put('image', $request->file('image'));  //almacena en una carpeta llamada 'image' el archivo request
                //todo este codigo superior genero una ruta relativa

                $post->fill(['file' => asset($path)])->save();
                //con fill agregamos a la variable post la ruta generada como 'file', asset convierte la ruta en una ruta completa
        }
        //image

        //etiquetas
        $post->tags()->sync($request->get('tags')); //sync relaciona todas las etiquetas agregadas
        //etiquetas

        return redirect()->route('posts.edit', $post->id)
            ->with('info', 'Entrada creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $this->authorize('pass', $post);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $post = Post::find($id);
        $this->authorize('pass', $post);

        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags = Tag::orderBy('name', 'ASC')->get();        

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::find($id);
        $this->authorize('pass', $post);

        //image
        if($request->file('image')){ //esta condicion verifica en el formulario si se ha enviado un archivo

            $path = Storage::disk('public')//almacenar en el disco public que busca en filesystems.php en config
                ->put('image', $request->file('image'));  //almacena en una carpeta llamada 'image' el archivo request
                //todo este codigo superior genero una ruta relativa

                $post->fill(['file' => asset($path)])->save();
                //con fill agregamos a la variable post la ruta generada como 'file', asset convierte la ruta en una ruta completa
        }
        //image

        //etiquetas
        $post->tags()->sync($request->get('tags')); //sync relaciona todas las etiquetas agregadas o eliminadas
        //etiquetas

        $post->fill($request->all());
        
        return redirect()->route('posts.edit', $post->id)
            ->with('info', 'Entrada actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$post = Post::find($id)->delete();  este codigo ejecuta directamente el delete
        $post = Post::find($id);
        $this->authorize('pass', $post);

        $post->delete();
        
        return back()->with('info', 'Eliminado correctamente');
    }
}
