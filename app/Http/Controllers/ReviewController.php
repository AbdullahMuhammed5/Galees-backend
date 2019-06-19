<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $reviews = DB::select("SELECT 
                (SELECT name from users where id = reviews.reviewer) as reviewer,
                (SELECT name from users where id = reviews.receiver) as receiver,
                reviews.rate, reviews.review from reviews");

        return $reviews;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return Review::create([
            'rate'=>$request['rate'],
            'review'=>$request['review'],
            'reviewer'=>$request['reviewer'],
            'receiver'=>$request['receiver']
        ]);
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
        return Review::where('receiver', $id)->get();
    }

    public function getReviewsToProfile($id){
        return Review::where('receiver', $id)
        ->join('users', 'users.id', '=', 'reviews.receiver')
        ->select('users.name', 'users.personalPic', 'reviews.rate', 'reviews.review')
        ->get();
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
        Review::find($id)->delete();
        return "deleted Successfully";
    }
}
