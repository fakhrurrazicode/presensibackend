<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolygonPoint extends Model
{
    use HasFactory;
    protected $table = 'polygon_points';
    protected $guarded = [];
}
