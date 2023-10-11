<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
//**Togi Samuel Simarmata
//  6706223067
//  D3 RPLA 46-03
class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('user.daftarPengguna', compact('users'));
    }

    public function showUser($username) {
        $user = User::where('username', $username)->firstOrFail();
        return view('user.infoPengguna', compact('user'));
    }

    public function create()
    {
    return view('user.registrasi');
    }

    public function store(Request $request)
    {

    }

    public function show()
    {

    }
}
