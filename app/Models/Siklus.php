<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siklus extends Model
{
    use HasFactory;
    protected $table = 'siklus';

    protected $fillable = [
        'kolam_id',
        'tgl_tebar',
        'total_tebar',
        'perhitungan',
        'spesies_udang',
        'umur_awal_udang',
        'target_sr',
        'lama_budidaya',
        'note'
    ];

    protected $with = [
        'panens'
    ];

    public function kolam()
    {
        return $this->belongsTo(Kolam::class);
    }

    public function panens()
    {
        return $this->hasMany(Panen::class);
    }
}
