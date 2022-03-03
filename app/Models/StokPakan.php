<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokPakan extends Model
{
    use HasFactory;
    protected $table = 'stok_pakan';

    protected $fillable = [
        'nama',
        'total_berat',
        'harga',
        'tgl_beli',
        'tgl_expired',
        'note'
    ];

    // protected $with = [
    //     'inputstokpakan'
    // ];

    public function inputstokpakan()
    {
        return $this->hasMany(InputPakan::class);
    }
}
