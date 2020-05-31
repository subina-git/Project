<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(5);
        return view('blog.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog/createblog');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
        ]);

        if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        }
        else{
            $filenameToStore = "noimage.jpg";
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->Blog = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->name = auth()->user()->name;
        $post->cover_images = $filenameToStore;
        $post->save();

        return redirect('/myblog')->with('success','Post added');
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
        return view('blog.show')->with('post',$post);
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
        if($post->user_id==auth()->user()->id)
            return view('blog.edit')->with('post',$post);
        else
            return redirect('/myblog')->with('error','You are not authorized');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
        ]);

        if($request->hasFile('cover_image')){
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        }

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->Blog = $request->input('body');
        if ($request->hasFile('cover_image')) {
            if ($post->cover_images != 'noimage.jpg') {
              Storage::delete('public/cover_images/'.$post->cover_images);
            }
            $post->cover_images = $filenameToStore;
          }
        $post->save();

        return redirect('/myblog')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post->user_id!=auth()->user()->id){
            return redirect('/myblog')->with('error','Not Authorized To Delete That Blog');
        }
        if($post -> cover_images != 'noimage.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_images);
        }
        $post->delete();
        return redirect('/myblog')->with('success','Deleted');
        
    }

    public function myblog()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('blog/myblog')->with('posts',$user->posts);
    }
}
