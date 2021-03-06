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

Route::resource('orders', 'OrderController');
Route::resource('users', 'UserController');
Route::resource('reviews', 'ReviewController');

Route::get('/get-profile-card', 'UserController@getProfileCard');

Route::get('/current-user/{email}', ['uses' => 'UserController@getCurrentUser']);

Route::get('/get-orders-num/{id}', 'OrderController@getOrders');

Route::put('/change-password/{id}', 'UserController@changePassword');

Route::put('/change-email/{id}', 'UserController@changeEmail');

Route::get('/get-profile-data/{id}', 'UserController@getProfileData');

Route::get('/get-received-reviews/{id}', 'ReviewController@getReviewsToProfile');

Route::get('/get-received-reviews-regular/{id}', 'ReviewController@regularUserReviews');

Route::get('/orders-history/{id}', 'OrderController@ordersHistory');

Route::get('/sitter-orders-history/{id}', 'OrderController@sittersOrderHistory');

