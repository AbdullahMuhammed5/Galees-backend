<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;

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
        return User::all();
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
        return User::find($id)->delete();
    }
}
