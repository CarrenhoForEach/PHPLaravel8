<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    //
    public function index(){
        //$posts = Post::get();
        //$posts = Post::orderBy('id', 'DESC')->paginate(3);
        //$posts = Post::orderBy('id', 'ASC')->paginate(3);
        $posts = Post::latest()->paginate(3);
        /*
         $posts = Post::all();
        return view('admin.posts.index', [
            'posts' => $posts
        ]);*/

        return view('admin.posts.index', compact('posts'));


    }

    public function create(){
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request){
        //dd($request->all());
        //$request->file('image');
        $data = $request->all();

        if($request->image->isValid()){
            //$image = $request->image->store('posts');
            
            $nameFile = Str::of($request->title)->slug('-').'.'.$request->image->getClientOriginalExtension();
            
            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }
        Post::create($data);
        return redirect()
        ->route('posts.index')
        ->with('message', 'Post criado com sucesso!!!');
        
    }

    public function show($id){
        //$post = Post::where('id', $id)->first();
        //dd($post);
        if(!$post = Post::find($id)){
            return redirect()->route('posts.index');
        }
        //dd($post);
        return view('admin.posts.show', compact('post'));
    }

    public function destroy($id){
        //dd("Deletando post {$id}");
        if(!$post = Post::find($id))
            return redirect()->route('posts.index');
            
        if(Storage::exists($post->image)){
            Storage::delete($post->image);
        }

        $post->delete();
        return redirect()
        ->route('posts.index')
        ->with('message', 'Post deletado com sucesso!!!');
    }

    public function edit($id){
        if(!$post = Post::find($id)){
            return redirect()->back();

        }

        return view('admin.posts.edit', compact('post'));
    }

    public function update(StoreUpdatePost $request ,$id){
       
        if(!$post = Post::find($id)){
            return redirect()->back();

        }

        $data = $request->all();

        if($request->image && $request->image->isValid()){
            //$image = $request->image->store('posts');
            if(Storage::exists($post->image)){
                Storage::delete($post->image);
            }


            $nameFile = Str::of($request->title)->slug('-').'.'.$request->image->getClientOriginalExtension();
            
            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }

        $post->update($data);

        return redirect()
        ->route('posts.index')
        ->with('message', 'Post atualizado com sucesso!!!');
        //return view('admin.posts.edit', compact('post'));
        //dd("Editando o post de id -> {$id}");
    }

    public function search(Request $request){

        //dd("Pesquisando por {$request->search}");
        //$posts = Post::where('title', '=', {$request->search})
        //$filters = $request->all();
        $filters = $request->except('_token');
        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
        ->orWhere('content', 'LIKE', "%{$request->search}%")
        ->paginate(3);

        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
