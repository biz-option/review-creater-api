<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormQuestionController;
use App\Http\Controllers\ReviewController;

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

// ユーザー情報取得用のルート
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// フォーム関連のルート
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/forms/create/{clientId}', [FormController::class, 'create'])->name('api.form.create');
    Route::delete('/forms/destroy/{formCode}', [FormController::class, 'destroy'])->name('api.form.destroy');
    Route::put('/forms/update/{formCode}', [FormController::class, 'update'])->name('api.form.update');
});

// フォーム質問関連のルート
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/form-questions/create/{formCode}', [FormQuestionController::class, 'create'])->name('api.form-question.create');
    Route::delete('/form-questions/destroy/{formQuestionId}', [FormQuestionController::class, 'destroy'])->name('api.form-question.destroy');
    Route::post('/form-questions/update/{formQuestionId}', [FormQuestionController::class, 'update'])->name('api.form-question.update');
    Route::post('/form-questions/change-sort-order/{formQuestionId}', [FormQuestionController::class, 'changeSortOrder'])->name('api.form-question.change-sort-order');
});

Route::get('/forms/{formCode}', [FormController::class, 'get'])->name('api.form.get');
Route::post('/reviews/{formCode}', [ReviewController::class, 'save'])->name('api.review.save');