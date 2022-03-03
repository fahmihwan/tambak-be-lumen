<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputKualitasAir extends Model
{
    use HasFactory;
    protected $table = 'input_kualitas_air';


    protected $fillable = [
        'kolam_id',
        'suhu_kolam',
        'tgl',
        'waktu',
        'note'
    ];


    // protected $with = [
    //     'kolam'
    // ];


    public function kolam()
    {
        return $this->belongsTo(Kolam::class);
    }
}
