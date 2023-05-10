<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::all();
        foreach ($posts as $post)
        {
            $post['created_at']=Carbon::parse($post['created_at']);
            $post['created_at']->format('d.m.Y');
        }
        return view('posts.posts',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users=User::all();
        return view('posts.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data=$request->all();
        Post::create($data);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post=Post::findOrFail($id);
//        $post->title= Attribute::make(
//            get: fn (string $title) => ucfirst($post->title),
//        );
//        dd($post->title);
        return view('posts.show',compact('post',));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id);
        $users=User::all();
        return view('posts.edit',compact('users','post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all());
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index');
        //$flight->forceDelete();
    }
    public function restore($id){
        Post::withTrashed()->find($id)->restore();
        return redirect()->route('posts.index');
    }
    public function restoreAll()
    {
        Post::onlyTrashed()->restore();
        return redirect()->route('posts.index');
    }
    function deletedPosts(){
       $posts=Post::onlyTrashed()->get();
        return view('posts.deleted',compact('posts'));
    }
    public function forceDelete(Post $post)
    {
        $post->forceDelete();
        return redirect()->route('posts.deleted');
    }

}
