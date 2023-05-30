<?php

namespace App\Http\Controllers;

use App\Mail\PostMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostMailController extends Controller
{
    public function index($id,$title,$email)
    {
        $maildata = [
            'title' => $title,
            'body' => 'Posted By '.$email,
            'url' =>' http://loginsystem.test/posts/'.$id.'/edit'
        ];

        Mail::to('admin@gmail.com')->send(new PostMail($maildata));

        // dd("Email is Sent.");
    }
}
