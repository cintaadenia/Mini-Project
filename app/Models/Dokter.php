<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'spesialis', 'no_hp', 'image'];

    public function jadwalPraktek()
    {
        return $this->hasMany(JadwalPraktek::class);
    }

    public function kunjungan(){
        return $this->hasMany(Kunjungan::class);
    }

    // Di dalam model Dokter.php
    public function user()
{
    return $this->belongsTo(User::class);
}
}

