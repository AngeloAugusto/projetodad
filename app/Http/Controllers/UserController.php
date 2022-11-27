<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /******RECEBER USER (GET)*****/
        
        return User::orderBy('created_at', 'DESC')->get();
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
        /******CRIAR USER (POST)*****/
        $newUser = new User();

        $newUser->name = $request->user["name"];
        $newUser->email = $request->user["email"];
        $newUser->password = $request->user["password"];
        $newUser->remember_token = $request->user["remember_token"];
        $newUser->type = $request->user["type"];
        $newUser->blocked = $request->user["blocked"];
        $newUser->photo_url = $request->user["photo_url"];

        $newUser->save();

        return $newUser;
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
        /****MODIFICAR VALOR (PUT)****/
        //Para conseguirmos modificar o estado blocked(0) que por omissão está "false" para blocked(1) "true" e vice-versa
        $existingUser = User::find( $id );

        //VERIFICAMOS SE O USER EXISTE E MODAMOS O VALOR BLOCKED
        //EXISTE
        if( $existingUser ){
            $existingUser->blocked = $request->user['blocked'];
            //carbon set the date and time
            $existingUser->updated_at = $request->user['blocked'] ? Carbon::now() : null;
            $existingUser->save();
            return $existingUser;
        }
        //NAO EXISTE
        return "User not found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingUser = User::find( $id );
        if($existingUser){
            $existingUser->delete();
            return "User successfully deleted";
        }
        return "User not found";
    }
}
