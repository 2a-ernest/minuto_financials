<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class DemoController extends Controller
{
    //

    public function index(Request $request){
    	//return all users in the db
    	$arr['users'] = $request->data;
    	// $arr['users'] = User::all();
    	return view('admin.test',$arr);
    }
}
