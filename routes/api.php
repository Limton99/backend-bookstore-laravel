<?php

use App\Http\Controllers\Api\V1\AuthApiController;
use App\Http\Controllers\Api\V1\BookApiController;
use App\Http\Controllers\Api\V1\CartController;
use App\Http\Controllers\Api\V1\CategoryApiController;
use App\Http\Controllers\Api\V1\CommentApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthApiController::class, 'login']);
Route::post('register', [AuthApiController::class, 'register']);

Route::group(['middleware'=>['auth:api', 'admin']], function() {
    Route::group(['prefix'=>'categories'], function() {
       Route::post('create', [CategoryApiController::class, 'store']);
        Route::post('update/{id}', [CategoryApiController::class, 'update']);
        Route::get('delete/{id}', [CategoryApiController::class, 'delete']);
    });

    Route::group(['prefix'=>'books'], function() {
        Route::post('create', [BookApiController::class, 'store']);
        Route::post('update/{id}', [BookApiController::class, 'update']);
        Route::get('delete/{id}', [BookApiController::class, 'delete']);
    });
});

Route::group(['prefix'=>'books'], function() {
    Route::get('all', [BookApiController::class, 'index']);
    Route::get('exclusive', [BookApiController::class, 'exclusive']);
    Route::get('popular', [BookApiController::class, 'popular']);
    Route::get('new', [BookApiController::class, 'new']);
    Route::get('one/{id}', [BookApiController::class, 'show']);
});

Route::group(['prefix'=>'categories'], function() {
    Route::get('all', [CategoryApiController::class, 'index']);
    Route::get('one/{id}', [CategoryApiController::class, 'show']);
});

Route::group(['middleware' => ['auth:api']], function() {
    Route::post('/logout', [AuthApiController::class, 'logout']);

   Route::group(['prefix'=>'comments'], function() {
       Route::post('create', [CommentApiController::class, 'store']);
       Route::post('update/{id}', [CommentApiController::class, 'update']);
       Route::get('delete/{id}', [CommentApiController::class, 'delete']);
   });

   Route::group(['prefix'=>'cart'], function() {
       Route::get('show', [CartController::class, 'index']);
       Route::get('addToCart/{id}', [CartController::class, 'addToCart']);
       Route::patch('update', [CartController::class, 'update']);
       Route::delete('delete', [CartController::class, 'remove']);
   });
});

Route::group(['prefix'=>'comments'], function() {
    Route::get('all', [CommentApiController::class, 'index']);
    Route::get('one/{id}', [CommentApiController::class, 'show']);
});

//Route::post('/createasd', [CategoryApiController::class, 'store']);



