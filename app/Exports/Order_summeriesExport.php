<?php

namespace App\Exports;

use App\Models\Order_summery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use App\Invoice;
use Illuminate\Contracts\View\View;

class Order_summeriesExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Order_summery::all();
    }
    public function view(): View
    {
        return view('excel.invoice', [
            'invoices' => Order_summery::all()
        ]);
    }
}
