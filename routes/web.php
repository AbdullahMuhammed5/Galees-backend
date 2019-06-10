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

Route::get('/get-profile-card', function(){
    $users = DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->select('users.name', 'users.address', 'users.career', 'users.personalPic', 
        DB::raw("TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE()) as age"),
        'profiles.hourlyRate', 'profiles.reviewRate', 'profiles.FAC', 
        'profiles.smoker', 'profiles.children', 'profiles.car', 'profiles.reviews')
        ->get();
    return $users;
});

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

