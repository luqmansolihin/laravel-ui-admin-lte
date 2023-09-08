<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    if (session('data') != null) {
        return to_route('dashboard');
    }

    return to_route('register');
});

Route::controller(AuthController::class)->group(function () {
   Route::group(['middleware' => 'guest'], function () {
       Route::get('login', 'loginView')->name('login');
       Route::post('login', 'loginProcess')->name('login.process');
       Route::get('register', 'registerView')->name('register');
       Route::post('register', 'registerProcess')->name('register.process');
   });

   Route::group(['middleware' => 'auth.login'], function () {
      Route::get('dashboard', function () {
         $users = \Illuminate\Support\Facades\Session::get('data');
         return view('home', compact('users'));
      })->name('dashboard');
      Route::post('logout', 'logout')->name('logout');
   });
});



