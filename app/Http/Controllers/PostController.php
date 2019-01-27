<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        /*
        |--------------------------------------------------------------------------
        | Functionality of Basic Query.
        |--------------------------------------------------------------------------
        */


        # insert
        // DB::table('users')->insert(
        //     [
        //         'name' => 'Manar', 
        //         'email' => 'manar@manar2.com',
        //         'password' => 'emad'
        //     ]
        // );

        # select
        $users = DB::table('users')->select('name', 'email as user_email')->get();
        
         # update
        // $users = DB::table('users')
        //     ->where('id', 1)
        //     ->update(['name' => 'Emadoo']);
        
        # delete
        # DB::table('users')->where('id', 3)->delete();

        return view('welcome', compact('users'));
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
        #
    }

    public function about($test, $tow){

       # return view('about')->with('test',$test);
        $peapole = ['Emad', 'Manar', 'yasmin'];

       return view('about', compact('peapole'));
    }
}
