<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HinhAnhTinTuc extends Model
{
    use HasFactory;

    protected $table = 'hinh_anh_tin_tucs';

    protected $fillable = ['tin_id', 'duongdan', 'ghi_chu'];

    public function tinTuc()
    {
        return $this->belongsTo(TinTuc::class, 'tin_id');
    }
}
