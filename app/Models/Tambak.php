<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tambak extends Model
{
    use HasFactory;
    protected $table = 'tambak';

    protected $fillable = [
        'nama',
        'negara',
        'alamat',
        'jumlah_kolam',
        'zona_waktu',
        'nama_awal_kolam',
        'luas',
    ];

    // protected $with = [
    //     'kolams'
    // ];

    public function kolams()
    {
        return $this->hasMany(Kolam::class);
    }

    public function scopeFilter($query)
    {
        $query->where(function ($query) {
            $query->join('kolam', 'tambak.id', '=', 'kolam.tambak_id');
        });
        return $query;
    }
}
