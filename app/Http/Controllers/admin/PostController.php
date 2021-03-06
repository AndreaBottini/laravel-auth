<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{   
    private $validateRules;

    public function __construct()
    {
    
        $this->validateRules = [
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'path_image' =>'image'
        ];
    }
    //solo admin
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->get();
        // $posts= Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();

        return view('admin.posts.create', compact('tags'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('store');
        $idUser = Auth::user()->id;
    
        // dd($request->all());
        $data = $request->all();
        $request->validate($this->validateRules);

        $path = Storage::disk('public')->put('images', $data['path_image']);

        $newPost = new Post;
        $newPost->title = $data['title'];
        $newPost->body = $data['body'];
        $newPost->user_id = $idUser;
        $newPost->slug = Str::finish(Str::slug($newPost->title), rand(1, 10000));
        $newPost->path_image = $path;

        $saved = $newPost->save();

        if(!$saved) {
            return redirect()->back(); 
        }

        //creo collegamento tra le tabelle ponte, passando array tags
        $tags = $data['tags'];
        if(!empty($tags)) {
            $newPost->tags()->attach($tags);
        }
            // dd($newPost->tags);
        return redirect()->route('admin.posts.show', $newPost->slug);  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $tags = Tag::all();
        $data = [ 
            'tags' => $tags,
            'post' => $post
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
         // dd('store');
         $idUser = Auth::user()->id;

         if(empty($post)) {
            abort(404);
        }
        if($post->user->id !=$idUser){
            abort(404);
        }
    
         // dd($request->all());
         $data = $request->all();

         $request->validate($this->validateRules);
 
         
         $post->title = $data['title'];
         $post->body = $data['body'];
         $post->slug = Str::finish(Str::slug($post->title), rand(1, 10000));
         $post->updated_at = Carbon::now();
 
         $updated = $post->update();
         if(!$updated) {
             return redirect()->back(); 
         }

         $tags = $data['tags'];
         if (!empty($tags)) {
            $post->tags()->attach($tags);
        }
 
         return redirect()->route('admin.posts.show', $post->slug);
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (empty($post)) {
            abort(404);
        }

        $post->tags()->detach();
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
