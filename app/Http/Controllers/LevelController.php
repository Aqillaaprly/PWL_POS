<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index() {
        //DB::insert('insert into m_level(level_code, level_name, created_at) values(?,?,?)', ['CUS', 'Pelanggan', now()]);
        //return 'Insert data baru berhasil';

        //DB::insert('INSERT INTO m_level (level_id, level_code, level_name, created_at) VALUES (?, ?, ?, ?)', 
    //[4, 'CUS', 'Pelanggan', now()]);


        //$row = DB::update('update m_level set level_name = ? where level_code = ?', ['Customer', 'CUS']);
        //return 'Update data berhasil. Jumlah data yang diupdate: ' .$row.' baris';

        //$row = DB::delete('delete from m_level where level_code = ?', ['CUS']);
        //return 'Delete data berhasil. Jumlah data yang dihapus: ' .$row.' baris';

        $data = DB::select('select * from m_level');
        return view('level', ['data' => $data]);
    }
}
