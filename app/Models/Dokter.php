<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'spesialis', 'no_hp', 'image', 'user_id'];

    public function jadwalPraktek()
    {
        return $this->hasMany(JadwalPraktek::class);
    }

    public function kunjungan(){
        return $this->hasMany(Kunjungan::class);
    }

    // Dokter.php
public function user()
{
    return $this->belongsTo(User::class);
}
}

