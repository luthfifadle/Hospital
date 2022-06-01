<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class mainController extends Controller
{
    public function loginAuth (Request $request) {
        $username = $request->username;
        $password = $request->password;

        $auth = Users::where('name', $username)->first();

        if ($auth && Hash::check($password, $auth->password)) {
            return view('rumahsakit');
        } else {
            return redirect('/')->with('status', 'Login Gagal, Username dan Password salah!');
        }
    }
}
