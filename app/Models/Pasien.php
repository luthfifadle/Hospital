<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $primaryKey = 'ps_id';

    public function rumahSakit () {
        return $this->belongsTo('App\Models\RumahSakit', 'rs_id', 'rs_id');
    }
}
