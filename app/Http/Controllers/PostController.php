<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class PostCOntroller extends Controller
{
    /**
     * Display a listing of the resource.

     * Show the form for creating a new resource.
     */

  public function index()
  {
    return view('post.post',[
        'posts' => Post::all()
    ]);
  }
    public function create()
    {
        return view('post.addpost',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Post $post)
    {
        // $file = $request->file("image");
        // dd($file);
        $data = request()->validate([
            'category_id' =>  ['required', Rule::exists('categories','id')],
            'name' => 'required',
            'excerpt' => 'required',
            'slug' => ['required',Rule::unique('posts','slug')->ignore($post->id)],
            'body' => 'required',
            'status' => 'required',
            'image' => 'required'
        ]);
        $data['user_id'] = auth()->id();
        $imagename = $request->file('image')->getClientOriginalName();
        $data['image'] = '/images/'.$imagename;
        request()->file('image')->move(public_path('images'),$imagename);
        // dd($data);
        Post::create($data);
        return redirect('/posts')->with('success','Post Added Successfully');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.editpost',['posts' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = request()->validate([
            'category_id' =>  ['required', Rule::exists('categories','id')],
            'name' => 'required',
            'excerpt' => 'required',
            'slug' => ['required',Rule::unique('posts','slug')->ignore($post->id)],
            'body' => 'required',
            'status' => 'required',
             'image' => $post->exists ? ['image'] : 'required|image'
        ]);
        // dd(request()->all());
        if($request->has('image'))
        {
        $imagename = $request->file('image')->getClientOriginalName();
        $data['image'] = '/images/'.$imagename;
        request()->file('image')->move(public_path('images'),$imagename);
        }
        $post->update($data);
        return redirect('/posts')->with('success','Post Edited Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('success', "Category Deleted");
    }
}
