<?php

namespace App\Exports;

use App\Models\StokPakan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StokPakanExport implements FromView
{
    public function view(): View
    {
        return view('exports.stok_pakan', [
            'stok' => StokPakan::all()
        ]);
    }
}
