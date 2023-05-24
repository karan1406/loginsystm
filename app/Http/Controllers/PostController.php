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
        return view('post.post', [
            'posts' => Post::all()
        ]);
    }

    public function create()
    {
        return view('post.addpost', [
            'categories' => Category::where('status', '=', 1)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        // $file = $request->file("image");
        // dd($file);
        $data = request()->validate([
            'category_id' =>  ['required', Rule::exists('categories', 'id')],
            'name' => 'required',
            'excerpt' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id . '|unique:categories,slug|regex:/(^[a-zA-Z-]+[a-zA-Z-]*$)/u',
            'body' => 'required',
            'image' => 'required'
        ]);
        $data['status'] = 0;
        $data['user_id'] = auth()->id();
        $imagename = $request->file('image')->getClientOriginalName();
        $data['image'] = '/images/' . $imagename;
        request()->file('image')->move(public_path('images'), $imagename);
        // dd($data);
        Post::create($data);
        return redirect('/posts')->with('success', 'Post Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        if (isset($_GET['search'])) {
            $posts = Post::where('body', 'LIKE', '%' . $_GET['search'] . '%')
                ->with('user', 'category')
                ->where('status', '1')
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $posts = Post::with('user', 'category')
                ->where('status', '1')
                ->orderBy('updated_at', 'desc')
                ->get()->take(4);
        }
        $categories = Category::with('posts')
            ->where('status', '1')
            ->get();
        if (count($posts) == 0) {
            session()->flash('NoPost', 'No Post Found');
            $posts = Post::with('user', 'category')
                ->where('status', '1')
                ->orderBy('updated_at', 'desc')
                ->get()->take(4);
        }
     return view('standblog.index',compact('posts','categories'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.editpost', ['posts' => $post]);
    }

    public function updateState(Post $post)
    {
        // dd($post);
        $data = ['status' => request()->status];
        $post->update($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = request()->validate([
            'category_id' =>  ['required', Rule::exists('categories', 'id')],
            'name' => 'required',
            'excerpt' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id . '|unique:categories,slug|regex:/(^[a-zA-Z-]+[a-zA-Z-]*$)/u',
            'body' => 'required',
            'image' => $post->exists ? ['image'] : 'required|image'
        ]);
        // dd(request()->all());
        if ($request->has('image')) {
            $imagename = $request->file('image')->getClientOriginalName();
            $data['image'] = '/images/' . $imagename;
            request()->file('image')->move(public_path('images'), $imagename);
        }
        $post->update($data);
        return redirect('/posts')->with('success', 'Post Edited Successfully');
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
