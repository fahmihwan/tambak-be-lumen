<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    use HasFactory;
    protected $table = 'panen';

    protected $fillable = [
        'siklus_id',
        'tgl',
        'total',
        'jml_udang',
        'harga_jual',
        'status',
        'note'
    ];
    // protected $with = [
    //     'siklus'
    // ];


    public function siklus()
    {
        return $this->belongsTo(Siklus::class);
    }
}
