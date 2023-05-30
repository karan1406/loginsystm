<?php

namespace App\Http\Controllers;

use App\Models\like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'post_id' => request()->id,
            'user_id' => Auth::id()
        ];

        if(like::where($data)->exists())
        {
            $like = like::where($data)->get();
            // dd($like->first()->status);
            if($like->first()->status == $request->status)
            {
            like::where($data)->delete();
            }
            else
            {
              like::where($data)->update(['status' => $request->status]);
            }
        }
        else
        {
            // dd('hello');
            $data['status'] = request()->status;
            like::create($data);
        }
        $id = request()->id;
        $post = Post::findorFail($id);
        // dd($post);
        $like = count($post->likes->where('status', 1));
        $dislike = count($post->likes->where('status', 0));
        return compact('like','dislike');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
