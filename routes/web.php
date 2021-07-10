<?php

use Illuminate\Http\Request;
use App\User;

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

Route::get('/', function () {
    return view('welcome');
});

//Basic Routing
Route::get('greeting', function() {
   return 'Hello world';
});

Route::get('getToken', function() {
   return csrf_token();
});

//Match method
Route::match(['get', 'post'], 'matchMethod', function () {
   return 'It`s a match method';
});

//Any method
Route::any('anyMethod', function() {
   return 'It`s an any method';
});

//Dependency Injection
Route::post('/userName', function (Request $request) {
    return 'Hello '. $request['name'];
});

//Redirect Routes
Route::redirect('greeting', 'getToken');

//View Routes
Route::view('/welcome', 'welcome');

//View Routes with array of data to pass to the view
//Route::view('/welcome', 'welcome', ['name' => 'Firdavs']);

//Required Parameters
Route::get('/welcome/{name}', function($name) {
   return view('welcome', ['name' => $name]);
});

//Optional Parameters
Route::get('/userName/{name?}', function($name = null) {
   return 'Hello '. $name;
});

//Regular Expression Constraints
Route::get('/userNameRegular/{name?}', function($name = null) {
    return 'Hello '. $name;
})->where('name', '[A-Za-z]+');

//Named Routes
Route::get('/user/profile', function() {
    return 'Named Route';
})->name('profile');

// Group Routes with prefix and name
Route::prefix('print')->name('print.')->group(function() {
   Route::get('/text', function() {
        return 'Print Text';
   })->name('text');

    Route::get('/number', function() {
       return 'Print Number';
    });
});

//Implicit Binding
Route::get('user/{user}', function(User $user) {
   return $user->email;
});