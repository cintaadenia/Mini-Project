<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPraktek extends Model
{
    use HasFactory;

    protected $fillable = ['dokter_id', 'hari', 'jam_mulai', 'jam_selesai'];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}

