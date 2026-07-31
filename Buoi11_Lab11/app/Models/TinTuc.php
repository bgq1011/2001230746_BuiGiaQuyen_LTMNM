<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TinTuc extends Model
{
    // [Bài tập 03]: Sử dụng SoftDeletes để cho phép xóa tạm vào thùng rác
    use SoftDeletes;

    protected $table = 'tin_tucs';

    // [Bài tập 03 & 05 & 06]: Khai báo các cột cho phép lưu hàng loạt (Mass Assignment)
    protected $fillable = [
        'tieude', 'slug', 'tomtat', 'noidung', 'ngaydang', 'trang_thai',
        'danhmuc_id', 'danh_muc_id', 'hinhanh', 'hinhanh_path'
    ];

    protected $casts = [
        'ngaydang' => 'date',
    ];

    // [Bài tập 02]: Quan hệ thuộc về 1 DanhMuc (belongsTo)
    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class, 'danhmuc_id');
    }

    // [Bài tập 07]: Quan hệ 1 tin tức có nhiều ảnh phụ (hasMany HinhAnhTinTuc)
    public function hinhAnhs()
    {
        return $this->hasMany(HinhAnhTinTuc::class, 'tin_id');
    }

    // [Bài tập 03]: Accessor lấy đường dẫn ảnh đại diện chuẩn
    public function getThumbUrlAttribute(): string
    {
        return $this->hinhanh_path
            ? asset('storage/' . $this->hinhanh_path)
            : asset('images/news/' . ($this->hinhanh ?? 'no-image.jpg'));
    }
}
