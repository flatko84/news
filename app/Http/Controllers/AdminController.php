<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function index(){
		$users = User::all();
		return view('admin.index', ['users' => $users]);
	}
	

	public function toggle(Request $request, $id) {

		$user = User::where('user_id', $id)->update(['admin' => $request->admin]);
		return json_encode($user);
	}

}
