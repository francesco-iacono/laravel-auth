<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Mail\PostMail;
use Illuminate\Support\Facades\Mail;


class PostController extends Controller
{
/*     private $postValidation = [
        'title'  => 'required|max:150',
        'subtitle' => 'required|max:100',
        'img_path' => 'mimes:jpeg,jpg,png',
        'publication_date' => 'required|date'
    ]; */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        /* dd($data); */
        
        $request->validate(
        [ 
            'title'  => 'required|max:150',
            'subtitle' => 'required|max:100',
            'img_path' => 'mimes:jpeg,jpg,png',
            'publication_date' => 'required|date'
        ]);
        // creazione e salvataggio del post
        $post = new Post();
        $data['slug'] = Str::slug($data['title']);
        $data['user_id'] = Auth::id();
        $data["img_path"] = Storage::disk('public')->put('images', $data["img_path"]);
        $post->fill($data);
        $postSaveResult = $post->save();

        if($postSaveResult) {
            Mail::to('pippo@gmail.com')->send(new PostMail($post));
            return redirect()
                ->route('admin.posts.index')
                ->with('message', 'Post ' . $post->title . ' creato correttamente!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
       /*  $data["img_path"] = Storage::disk('public')->put('images', $data["img_path"]); */


        $request->validate(
            [ 
                'title'  => 'required|max:150',
                'subtitle' => 'required|max:100',
                'img_path' => 'mimes:jpeg,jpg,png',
                'publication_date' => 'required|date'
        ]);

        $post->update($data);

        return redirect()
        ->route('admin.posts.index')
        ->with('message', 'Post' . $post->title . ' aggiornato correttamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        /* dd($post); */
        return redirect()
        ->route('admin.posts.index')
        ->with('message', 'Il post '. $post->title .  ' è stata cancellato correttamente!');
    }
}
