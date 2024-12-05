<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_assigned' => 'boolean',
    ];

    public function pasien(){
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function rekamMedis()
    {
        return $this->hasOne(RekamMedis::class);
    }

    public function resep(){
        return $this->hasMany(Resep::class);
    }

    public function user(){
        $this->belongsTo(User::class);
    }
}

