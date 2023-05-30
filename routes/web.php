<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotifyController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Mail\PostMail;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    // dd(request()->session('url'));
    return view('index');
})
->middleware(['guest'])
->name('login');

Route::get('/admin',function(){
    $posts = Post::all();
    $comments = Comment::all();
  return view('admin.admin',compact('posts','comments'));
})->middleware('auth');


// Route::get('/standblog',function (){
//     // $posts = Post::latest('updated_at')->get()->take(4);
//     //  return view('standblog.index',compact('posts'));
// });

Route::get('/',[PostController::class,'show']);
Route::get('/post/blog',function(){
    $posts = Post::latest('updated_at')->get()->toQuery()->paginate(6)->withQueryString();
    return view('standblog.blog',compact('posts'));
});



Route::get('/postdetail/{post:slug}',function(Post $post){
     return view('standblog.post',[
        'post' => $post,
        'posts' => Post::all()
     ]);
});

Route::get('/categorydetail/{category:slug}',function(Category $category){
    return view('standblog.blog',[
        'posts' => $category->posts->load('category')->toQuery()->paginate(6)->withQueryString(),
        // 'posts' => Post::all()
    ]);
});

Route::get('/author/{user}',function(User $user){
    return view('standblog.blog',[
        'posts' => $user->posts->load('user','category')->toQuery()->paginate(6)->withQueryString(),
        // 'posts' => Post::all()
    ]);
});
// Route::get('/login',[AdminController::class,'create']);
Route::post('/login',[AdminController::class,'create']);
Route::get('/register',[RegisterController::class,'create']);
Route::post('/register',[RegisterController::class,'store']);
Route::post('/logout',[AdminController::class,'destroy']);



Route::resource('posts', PostController::class)->middleware(['auth','post']);
Route::resource('comments', CommentController::class)->middleware('auth');
Route::resource('likes', LikeController::class)->middleware('auth');

Route::get('/403',function(){
      abort(403);
});




Route::group([
    'middleware' => ['auth','category'],
],function () {
    Route::get('/category',[CategoryController::class,'create'])->middleware('auth');
    Route::post('/category/store',[CategoryController::class,'store'])->name('category.store')->middleware('auth');
    Route::delete('/category/delete/{category}',[CategoryController::class,'destroy'])->name('category.destroy')->middleware('auth');
    Route::patch('/category/update/{category}',[CategoryController::class,'update'])->name('category.update')->middleware('auth');
}
);

Route::resource('users',UserController::class)->middleware('user');
Route::resource('roles',RoleController::class)->middleware('roles');


// Route::resource('users',UserController::class);
Route::post('/updateState/{user}',[UserController::class,'updateState']);
Route::patch('/post/updateState/{post}',[PostController::class,'updateState']);
Route::patch('/category/updateState/{category}',[CategoryController::class,'updateStatus']);
Route::post('/updatePermission/{role}',[RoleController::class,'updatepermission']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/notify',[NotifyController::class,'sendMail']);

Route::get('/profile/{lang}',function($lang)
{
    App::setlocale($lang);
    return view('profile');
});
