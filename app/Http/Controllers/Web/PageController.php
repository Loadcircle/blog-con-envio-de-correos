<?php

namespace Blogs\Http\Controllers\Web;

use Illuminate\Http\Request;
use Blogs\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Blogs\Mail\sendMail;
use Blogs\Post;
use Blogs\Category;

class PageController extends Controller
{
    public function blog(){
        $posts = Post::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);
        return view('web.posts', compact('posts'));
    }

    public function category($slug){
        $category = Category::where('slug', $slug)->pluck('id')->first();
        $posts = Post::where('category_id', $category)
                ->orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);

        return view('web.posts', compact('posts'));
    }

    public function tag($slug){
        
        $posts = Post::whereHas('tags', function($query) use ($slug){
                $query->where('slug', $slug);
        })->orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(3);

        return view('web.posts', compact('posts'));
    }

    public function post($slug){
        $post = Post::where('slug', $slug)->first();
        
        return view('web.post', compact('post'));
    }

    public function contacto(){
        return view('web.contacto');
    }

    public function enviar(Request $request){
        Mail::to('jesusmilano96@gmail.com')->send(new sendMail($request->nombre, $request->apellido, $request->email, $request->telefono, $request->mensaje));
    }
}
