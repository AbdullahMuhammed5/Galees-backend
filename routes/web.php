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

Route::get('/auth', function () {
    //Perform a check whether the user is authenticated or not
    //Remove the if block during production
    if(!Auth::check())
    {
        //If they are not, we forcefully login the user with id=1
        $user = App\User::find(1);
        Auth::login($user);
    }
    return Auth::user();
});

Route::get('/get-profile-card', function(){
    $users = DB::table('users')
        ->join('profiles', 'users.id', '=', 'profiles.user_id')
        ->select('users.name', 'users.address', 'users.career',
        'profiles.hourlyRate', 'profiles.reviewRate')
        ->get();
    return $users;
});

Route::resource('orders', 'OrderController');

Route::get('/get-orders-num/{id}', function($id){
    return App\Order::select(DB::raw('COUNT(`sitter_id`) AS orders_num'))
                    ->where('sitter_id', $id)->groupBy('sitter_id')->first()->orders_num;
});

// Route::get('/get-orders-num/{id}', 'OrderController@getOrders');