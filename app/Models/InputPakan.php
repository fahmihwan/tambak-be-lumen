<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputPakan extends Model
{
    use HasFactory;
    protected $table = 'input_pakan';

    protected $fillable = [
        'kolam_id',
        'stok_pakan_id',
        'tgl',
        'waktu',
        'jumlah',
        'note'
    ];

    protected $with = [
        'stokpakan'
    ];

    public function stokpakan()
    {
        return $this->belongsTo(StokPakan::class, 'stok_pakan_id');
    }

    public function kolam()
    {
        return $this->belongsTo(Kolam::class);
    }
}
