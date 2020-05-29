<?php

namespace App\Exports;

use App\OrderDetail;
use Maatwebsite\Excel\Concerns\FromCollection;

class SalesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
    	$orders = OrderDetail::whereStatus('paid')->get();
        return $orders;
    }
}
