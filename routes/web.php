<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/get-profile-card', 'UserController@getProfileCard');

Route::get('/get-img/{imgName}', function($imgName){
    $filePath = storage_path('app/public/'.$imgName);
    if(!File::exists($filePath)){
        abort(404);
    }
    $file = File::get($filePath);
    $type = File::mimeType($filePath);
    
    $response = Response::make($file, 200);
    $response->header("Content-type", $type);

    return $response;
});

Route::get('/current-user/{email}', function($email){
    return App\User::where('email', $email)
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->select('users.*', 'profiles.*')->first();
});

