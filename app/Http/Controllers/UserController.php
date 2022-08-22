<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(){

        return User::all();
    }

    public function show($id):Response
    {

        $response = user::where('id',$id)->get();

        return response($response,200);
    }
}
