<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminController extends Controller {

	public function index() {
		$users = User::where('id', '!=', Auth::id())->get();
		return view('admin.index', ['users' => $users]);
	}

	public function toggle(Request $request, $id) {

		$user = User::where('id', $id)->update(['admin' => $request->admin]);
		return json_encode($user);
	}

}
