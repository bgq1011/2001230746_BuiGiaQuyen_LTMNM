<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMuc extends Model
{
    use HasFactory;

    protected $table = 'danh_mucs';
    protected $fillable = ['ten'];

    public function tinTucs()
    {
        return $this->hasMany(TinTuc::class, 'danh_muc_id');
    }
}
