<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Bidang;
use App\Models\Golongan;
use App\Models\Presensi;
use App\Models\AbsensiRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    const JENIS_KELAMIN_LAKI_LAKI = 1;
    const JENIS_KELAMIN_PEREMPUAN = 2;

    use HasFactory, SoftDeletes;
    protected $table = 'pegawai';
    protected $guarded = [];

    public $appends = ['jenis_kelamin_text', 'today_presensi'];

    public function getJenisKelaminTextAttribute()
    {
        if ($this->jenis_kelamin == SELF::JENIS_KELAMIN_LAKI_LAKI) return 'LAKI-LAKI';
        if ($this->jenis_kelamin == SELF::JENIS_KELAMIN_PEREMPUAN) return 'PEREMPUAN';
        return 'TIDAK DIKETAHUI';
    }



    public function getTodayPresensiAttribute()
    {
        $presensi = Presensi::whereDate('checked_in_at', Carbon::today())
            ->where('presensi', 'hadir')
            ->where('pegawai_id', $this->id)
            ->first();
        return $presensi;
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'pegawai_id', 'id');
    }

    public function absensi_request()
    {
        return $this->hasMany(AbsensiRequest::class, 'pegawai_id', 'id');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }

    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id', 'id');
    }


    public function user()
    {
        return $this->hasOne(User::class, 'pegawai_id', 'id');
    }
}
