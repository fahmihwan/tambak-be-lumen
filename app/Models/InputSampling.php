<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputSampling extends Model
{
    use HasFactory;
    protected $table = 'input_sampling';

    protected $fillable = [
        'kolam_id',
        'tgl',
        'waktu',
        'berat_udang',
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
