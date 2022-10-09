<?php

namespace App\Models;

use App\Models\Bidang;

use App\Models\Pegawai;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presensi extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'presensi';
    protected $guarded = [];

    public $appends = ['checked_in_image_url', 'checked_out_image_url'];



    public function getCheckedInImageUrlAttribute()
    {
        if (!$this->checked_in_image) return;
        return url('/storage/' . $this->checked_in_image);
    }

    public function getCheckedOutImageUrlAttribute()
    {
        if (!$this->checked_out_image) return;
        return url('/storage/' . $this->checked_out_image);
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }
}
