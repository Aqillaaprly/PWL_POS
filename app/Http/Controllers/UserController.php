<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        // tambah data user dengan Eloquent Model
        $data = [
            'name' => 'Pelanggan Pertama',
            
        ];
        UserModel::where('username', 'customer-1')->update($data); 

        $user = UserModel::all();
        return view('user', ['data'=> $user]);
    }
}
