<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kolam extends Model
{
    use HasFactory;
    protected $table = 'kolam';

    protected $fillable = [
        'tambak_id',
        'nama',
        'luas'
    ];

    protected $with = [
        'sikluses',
        'tambak',
        'inputsampling',
        'inputkualitasair',
        'inputpakan'
    ];

    public function sikluses()
    {
        return $this->hasMany(Siklus::class);
    }

    public function tambak()
    {
        return $this->belongsTo(Tambak::class);
    }

    public function inputsampling()
    {
        return $this->hasMany(InputSampling::class);
    }

    public function inputkualitasair()
    {
        return $this->hasMany(InputKualitasAir::class);
    }

    public function inputpakan()
    {
        return $this->hasMany(InputPakan::class);
    }
}
