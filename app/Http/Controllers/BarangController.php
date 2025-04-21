<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\LevelModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangController extends Controller
{
    public function index()
    {
        $activeMenu = 'barang';
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];
        $kategori = KategoriModel::select('category_id', 'category_name')->get();

        return view('barang.index', [
            'activeMenu' => $activeMenu,
            'breadcrumb' => $breadcrumb,
            'category' => $kategori
        ]);
    }

    public function list(Request $request)
    {
        $barang = BarangModel::select
        ('barang_id', 
        'category_id', 
        'barang_kode', 
        'barang_nama', 
        'harga_beli', 
        'harga_jual'
    )->with('kategori');

    $category_id = $request->input('filter_kategori');

    if (!empty($category_id)) {
        $barang->where('category_id', $category_id);
    }

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('action', function ($barang) {
                $btn = '<button onclick="modalAction(\'' . url('/barang/' . $barang->barang_id) . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/barang/' . $barang->barang_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Delete</button> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function show(string $id)
    {
        $barang = BarangModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Barang'
        ];

        $activeMenu = 'barang';

        return view('barang.show_ajax', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'barang' => $barang,
            'activeMenu' => $activeMenu
        ]);
    }


    public function create_ajax()
    {
        $kategori = KategoriModel::select('category_id', 'category_name')->get();
        return view('barang.create_ajax')->with('kategori', $kategori);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'category_id' => 'required|integer|exist:m_category,category_id',
                'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode',
                'barang_nama' => 'required|string|max:100',
                'harga_beli' => 'required|numeric',
                'harga_jual' => 'required|numeric'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            BarangModel::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data barang berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $barang = BarangModel::find($id);
        $level = LevelModel::select('level_id','level_name')->get();
        return view('barang.edit_ajax', ['barang'=>$barang, 'level'=>$level]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'category_id' => 'required|integer|exist:m_category,category_id',
                'barang_kode' => 'required|string|max:10|unique:m_barang,barang_kode,' . $id . ',barang_id',
                'barang_nama' => 'required|string|max:100',
                'harga_beli' => 'required|numeric',
                'harga_jual' => 'required|numeric'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $check = BarangModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data barang berhasil diperbarui'
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $barang = BarangModel::find($id);
        return view('barang.confirm_ajax', ['barang' => $barang]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $barang = BarangModel::find($id);
            if ($barang) {
                $barang->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data barang berhasil dihapus'
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function import()
{
    return view('barang.import'); 
}

public function import_ajax(Request $request)
{
    if ($request->ajax() || $request->wantsJson()) {
        // file validation must be xls or xlsx, max 1MB
        $rules = [
            'file_barang' => ['required', 'mimes:xlsx,xls', 'max:1024']
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation Failed',
                'msgField' => $validator->errors()
            ]);
        }

        $file = $request->file('file_barang'); // Retrieve files from requests
        $reader = IOFactory::createReader('Xlsx'); // Load Reader Excel File
        $reader->setReadDataOnly(true); // Read only data
        $spreadsheet = $reader->load($file->getRealPath()); // Load Excel file
        $sheet = $spreadsheet->getActiveSheet(); // Take an active sheet
        $data = $sheet->toArray(null, false, true, true); // Retrieve Excel Data

        $insert = [];
        if (count($data) > 1) {
            // if the data is more than 1 line
            foreach ($data as $baris => $value) {
                if ($baris > 1) { // line 1 is the header, skip
                    $insert[] = [
                        'category_id' => $value['A'],
                        'barang_kode' => $value['B'],
                        'barang_nama' => $value['C'],
                        'harga_beli' => $value['D'],
                        'harga_jual' => $value['E'],
                        'created_at' => now(),
                    ];
                }
            }

            if (count($insert) > 0) {
                // insert data into the database, if the data already exists, then it is ignored
                BarangModel::insertOrIgnore($insert);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data imported successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No data imported'
            ]);
        }
    }

    return redirect('/');
}

public function export_excel()
    {
        // ambil data barang yang akan di export
        $barang = BarangModel::select('category_id','barang_kode','barang_nama','harga_beli','harga_jual')
                    ->orderBy('category_id')
                    ->with('kategori')
                    ->get();

        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif

        $sheet->setCellValue('A1', 'Kategori Id');
        $sheet->setCellValue('B1', 'Kode Barang');
        $sheet->setCellValue('C1', 'Nama Barang');
        $sheet->setCellValue('D1', 'Harga Beli');
        $sheet->setCellValue('E1', 'Harga Jual');

        $sheet->getStyle('A1:E1')->getFont()->setBold(true); // bold header

        $baris = 2;      // baris data dimulai dari baris ke 2
        foreach ($barang as $key => $value) {
            $sheet->setCellValue('A' . $baris, $value->kategori->category_id);
            $sheet->setCellValue('B' . $baris, $value->barang_kode);
            $sheet->setCellValue('C' . $baris, $value->barang_nama);
            $sheet->setCellValue('D' . $baris, $value->harga_beli);
            $sheet->setCellValue('E' . $baris, $value->harga_jual);
            $baris++;
        }

        foreach(range('A','E') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size untuk kolom
        }

        $sheet->setTitle('Data Barang'); // set title sheet

        $writer = IOFactory::createWriter($spreadsheet, 'xlsx');
        $filename = 'Data Barang ' . date('Y-m-d H:i:s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    } // end function export_excel

    public function export_pdf()
    {
        $barang = BarangModel::select('category_id','barang_kode','barang_nama','harga_beli','harga_jual')
                    ->orderBy('category_id')
                    ->orderBy('barang_kode')
                    ->with('kategori')
                    ->get();

        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('barang.export_pdf', ['barang' => $barang]);
        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url
        $pdf->render();

        return $pdf->stream('Data Barang '.date('Y-m-d H:i:s').'.pdf');
    }
}