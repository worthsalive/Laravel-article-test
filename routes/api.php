<?php

use App\Http\Controllers\V1\CommentController;
use App\Http\Controllers\V1\ArticleController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::prefix('/articles')->group(function () {
//     Route::get('/',[ArticleController::class,'index']);
//     Route::post('/',[ArticleController::class,'store']);

//     Route::get('/{article}/comment',[CommentController::class,'index']);
//     Route::get('/{id}/like',[ArticleController::class,'likeCount']);
//     Route::get('/{id}/view',[ArticleController::class,'viewCount']);

//     Route::get('/{article}',[ArticleController::class,'show']);
//     Route::put('/{article}',[ArticleController::class,'update']);
//     Route::delete('/{article}',[ArticleController::class,'update']);
// });

Route::prefix('/v1')->group(function () {
    Route::apiResource('articles',ArticleController::class);

    Route::prefix('/articles')->group(function (){
        Route::get('/{article}/comments',[CommentController::class,'index']);
        Route::put('/{article}/like',[ArticleController::class,'likeCounter']);
        Route::put('/{article}/view',[ArticleController::class,'viewCounter']);
    });
});
Route::apiResource('comment',CommentController::class);
