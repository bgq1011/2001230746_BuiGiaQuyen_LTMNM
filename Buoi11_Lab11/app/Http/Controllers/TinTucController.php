<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;
use App\Models\DanhMuc;

class TinTucController extends Controller
{
    public function index(Request $request)
    {
        $danhMucId = $request->query('danh_muc_id');
        $tuKhoa = $request->query('keyword');

        $query = TinTuc::query()->orderByDesc('ngaydang')->orderByDesc('id');

        if ($danhMucId) {
            $query->where('danh_muc_id', $danhMucId);
        }

        if ($tuKhoa) {
            $query->where('tieude', 'LIKE', "%{$tuKhoa}%");
        }

        $dsTin = $query->paginate(6)->withQueryString();
        $dsDanhMuc = DanhMuc::all();

        return view('tintuc.index', compact('dsTin', 'dsDanhMuc', 'danhMucId', 'tuKhoa'));
    }

    public function show($key)
    {
        $tin = TinTuc::where('slug', $key)->orWhere('id', $key)->firstOrFail();
        return view('tintuc.chitiet', compact('tin'));
    }
}
