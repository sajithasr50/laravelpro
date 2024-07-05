<?php

use App\Http\Controllers\CreateFormController;
use App\Http\Controllers\UserController;
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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('form/{id}', 'HomeController@formshow')->name('home.formshow');
    Route::post('/submission', 'HomeController@submission')->name('home.submission');


    Route::group(['middleware' => ['guest']], function () {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function () {
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::get('user/list', [UserController::class, 'list'])->name('user.list');

        Route::post('/change-password', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('update-password');
        Route::get('createform/', [CreateFormController::class, 'index'])->name('createform.index');
        Route::get('createform/create', [CreateFormController::class, 'create'])->name('createform.create');
        Route::post('createform/store', [CreateFormController::class, 'store'])->name('createform.store');
        Route::post('createform/update', [CreateFormController::class, 'update'])->name('createform.update');
        Route::get('createform/showform/{id}', [CreateFormController::class, 'showform'])->name('createform.showform');
        Route::get('createform/edit/{id}', [CreateFormController::class, 'edit'])->name('createform.edit');

        Route::post('/change-privilege', [App\Http\Controllers\UserController::class, 'updatePrivilege'])->name('update-privilege');
        Route::get('user/editprivilege/{id}', [UserController::class, 'editprivilege'])->name('user.editprivilege');
        Route::get('/send-email-to-user', [App\Http\Controllers\CustController::class, 'index']);
    });
});
