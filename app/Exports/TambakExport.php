<?php

namespace App\Exports;

use App\Models\Tambak;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class TambakExport implements FromView
{
    public function view(): View
    {
        return view('exports.tambak', [
            'tambak' => Tambak::all()
        ]);
    }
}
