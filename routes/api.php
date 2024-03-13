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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('api.user.get');

    Route::controller(FormController::class)->group(function () {
        Route::post('/forms/create/{clientId}', 'create')->name('api.form.create');
//        Route::post('/forms/create/{clientId}', 'create')->where('clientId', '[0-9]+')->name('api.form.create');
        Route::delete('/forms/destroy/{formCode}', 'destroy')->where('formCode', '[0-9A-Z]{24}')->name('api.form.destroy');
        Route::put('/forms/update/{formCode}', 'update')->where('formCode', '[0-9A-Z]{24}')->name('api.form.update');
    });

    Route::controller(FormQuestionController::class)->group(function () {
        Route::post('/form-questions/create/{formCode}', 'create')->where('formCode', '[0-9A-Z]{24}')->name('api.form-question.create');
        Route::delete('/form-questions/destroy/{formQuestionId}', 'destroy')->where('formQuestionId', '[0-9]+')->name('api.form-question.destroy');
        Route::put('/form-questions/update/{formQuestionId}', 'update')->where('formQuestionId', '[0-9]+')->name('api.form-question.update');
        Route::post('/form-questions/change-sort-order/{formQuestionId}', 'changeSortOrder')->where('formQuestionId', '[0-9]+')->name('api.form-question.change-sort-order');
    });
});

Route::get('/forms/{formCode}', [FormController::class, 'get'])->where('formCode', '[0-9A-Z]{24}')->name('api.form.get');
Route::post('/reviews/{formCode}', [ReviewController::class, 'save'])->where('formCode', '[0-9A-Z]{24}')->name('api.review.save');