<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = ['resep_id', 'nama_obat', 'jumlah', 'dosis'];

    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }
}

