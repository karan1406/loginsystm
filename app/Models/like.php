<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function post()
    {
     return $this->belongsTo(Post::class);
    }
    public function user()
    {
     return $this->belongsTo(User::class);
    }
}
