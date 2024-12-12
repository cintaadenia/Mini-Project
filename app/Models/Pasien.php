<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'alamat', 'no_hp', 'tanggal_lahir', 'user_id'];

    public function kunjungan()
{
    return $this->hasMany(Kunjungan::class);
}
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

