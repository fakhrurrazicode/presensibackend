<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HariJamKerja extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'hari_jam_kerja';
    protected $guarded = [];
}
