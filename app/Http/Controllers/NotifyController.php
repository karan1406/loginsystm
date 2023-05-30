<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\PostNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotifyController extends Controller
{
    public function sendMail($user,$slug)
    {
        $notifydata = [
            'body' => 'for test purpose',
            'title' => 'title',
            'url' => url('/')
        ];
        $user = User::first();
        Notification::send($user, new PostNotify($notifydata));
    }
}
