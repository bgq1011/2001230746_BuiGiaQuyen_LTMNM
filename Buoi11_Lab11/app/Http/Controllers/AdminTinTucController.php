<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;
use App\Models\DanhMuc;

class AdminTinTucController extends Controller
{
    public function index()
    {
        $dsTin = TinTuc::with('danhMuc')->orderByDesc('id')->paginate(10);
        return view('admin.tintuc.index', compact('dsTin'));
    }

    public function create()
    {
        $dsDanhMuc = DanhMuc::all();
        return view('admin.tintuc.create', compact('dsDanhMuc'));
    }

    public function edit($id)
    {
        $tin = TinTuc::findOrFail($id);
        $dsDanhMuc = DanhMuc::all();
        return view('admin.tintuc.edit', compact('tin', 'dsDanhMuc'));
    }
}
