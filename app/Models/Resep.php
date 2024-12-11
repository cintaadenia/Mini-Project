<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = ['kunjungan_id','rekam_medis_id','deskripsi'];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function obat()
    {
        return $this->hasMany(Obat::class);
    }
    public function rekamMedis()
{
    return $this->belongsTo(RekamMedis::class);
}
}

