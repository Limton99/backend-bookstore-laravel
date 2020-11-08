<?php

use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\BooksController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\CommentsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['auth', 'admin']], function() {
    Route::get('/', function () {
        return view('pages.main');
    });

    Route::group(['prefix'=>'books'], function() {
        Route::get('/', [BooksController::class, 'index'])->name('books');
        Route::post('/store', [BooksController::class, 'store'])->name('books-create');
        Route::post('/update', [BooksController::class, 'update'])->name('books-update');
        Route::get('/delete/{id}', [BooksController::class, 'destroy'])->name('book-delete');
    });


    Route::group(['prefix'=>'categories'], function() {
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories-create');
        Route::post('/update', [CategoryController::class, 'update'])->name('categories-update');
        Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category-delete');
    });

    Route::group(['prefix'=>'comments'], function() {
        Route::get('/', [CommentsController::class, 'index'])->name('comments');

        Route::get('/delete/{id}', [CommentsController::class, 'destroy'])->name('comment-delete');
    });


});


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


