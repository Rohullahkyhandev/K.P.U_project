<?php

namespace App\Http\Controllers;

use App\Imports\ImportPack;
use App\Models\Pack;
use Illuminate\Http\Request;
use Excel;

class PackController extends Controller
{


    public function index()
    {
        $data = Pack::all();
        return view('pack.index', compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'mimes:xls,xlsx'
        ]);
        $path =  $request->file('file')->getRealPath();
        Excel::import(new ImportPack, $path);
    }
}
