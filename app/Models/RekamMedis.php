<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $fillable = ['kunjungan_id', 'diagnosa', 'tindakan', 'image'];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }
    
    public function images()
{
    return $this->hasMany(RekamMedisImage::class);
}

public function resep()
{
    return $this->hasMany(Resep::class);
}


}

