<?php

namespace App\Models;

use App\Models\Bidang;

use App\Models\Pegawai;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AbsensiRequest extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'absensi_request';
    protected $guarded = [];

    public $appends = ['attachment_file_url'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }



    public function getAttachmentFileUrlAttribute()
    {
        if ($this->attachment_file == '' || $this->attachment_file == null) {
            return null;
        }
        return url('/storage/' . $this->attachment_file);
    }
}
