<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\DataTables\UsersDataTable;
//**Togi Samuel Simarmata
//  6706223067
//  D3 RPLA 46-03
class UserController extends Controller
{
    public function index(UsersDataTable $dataTable) {
        return $dataTable->render('user.daftarPengguna');
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
