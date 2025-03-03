<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index(){
        /*$data = [
            'category_code' => 'SNK',
            'category_name' => 'Snack',
            'created_at' => now()
        ];
        DB::table('m_category')->insert($data);
        return 'Insert data baru berhasil';*/

        //$row = DB::table('m_category')->where('category_code', 'SNK')->update(['category_name' => 'Camilan']);
        //return 'Update data berhasil. Jumlah data yang diupdate: ' .$row.' baris';

        //$row = DB::table('m_category')->where('category_code', 'SNK')->delete();
        //return 'Delete data berhasil. Jumlah data yang dihapus: ' .$row.' baris';

        $data = DB::table('m_category')->get();
        return view('category', ['data' => $data]);
    }
}
