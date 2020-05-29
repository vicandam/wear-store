<?php

namespace App\Exports;

use App\OrderDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesExportView implements FromView
{
    public function view(): View
    {
    	$orders = OrderDetail::whereStatus('paid')->get(); 

        return view('reports.table.sales', [
            'orders' => $orders
        ]);
    }
}
