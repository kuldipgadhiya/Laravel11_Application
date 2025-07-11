<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', function() {
    return view('home');
})->name('home');


// Optional Routes Definition
Route::get('users/{userId?}', function($userId = null) {
    return ["User Id" => $userId];
});


Route::get('blogs/{id?}', function($id = null) {
    return "The blog id is : {$id}";
})->where('id', '[0-9]{3,}[a-z]*');

Route::get('/contact-us', function() {
    return view('contact.index');
})->name('contact-us');

Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('posts/store', [PostController::class, 'store'])->name('posts.store');
Route::get('posts/show/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::patch('posts/update/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('posts/destroy/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
