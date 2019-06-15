<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return \App\User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return User::create([
        //     'fName' => '',
        //     'lName' => '',
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     'address' => '',
        //     'phone' => '',
        //     'birthdate' => '',
        //     'gender' => '',
        //     'career' => '',
        //     'imgID' => '',
        //     'imgPolice' => '',
        //     'personalPic' => ''
        // ]);

        echo "Helllllo";
    }

    public function getCurrentUser($email){
        $currUser = User::where('email', $email)->first();
        if($currUser->role == 1){ // case of sitter user
            return User::where('email', $email) // sitter needs additional data from profiles table
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('users.*', 'profiles.*')->first();
        } else if($currUser->role == 2){ // case of regular user (client)
            return $currUser;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return print_r($request);
       return User::create([
            'fName' => $request['fname'],
            'lName' => $request['lname'],
            'name' => $request['fname']."_".$request['lname'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'address' => $request['location'],
            'phone' => $request['phone'],
            'birthdate' => null,
            'gender' => $request['gender'],
            'career' => $request['career'],
            'imgID' => $request['imgID'],
            'imgPolice' => $request['imgPolice'],
            'personalPic' => $request['personalPic'],
        ]);
        // echo $request;
    }

    public function getProfileCard(){
        $users = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select('users.name', 'users.address', 'users.career', 'users.personalPic', 'users.gender',
            DB::raw("TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE()) as age"),
            'profiles.hourlyRate', 'profiles.reviewRate', 'profiles.FAC', 
            'profiles.smoker', 'profiles.children', 'profiles.car', 'profiles.reviews', 'profiles.experience')
            ->get();
        return $users;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
