<?php

namespace App\Exports;

use App\OrderDetail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReceivableExportView implements FromView
{
    public function view(): View
    {
    	$orders = OrderDetail::whereStatus('payable')->get(); 

        return view('reports.table.receivable', [
            'orders' => $orders
        ]);
    }
}
