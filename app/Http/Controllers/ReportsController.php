<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use paginate;
use App\OrderDetail;
use App\Item;
use App\Exports\SalesExport;
use App\Exports\SalesExportView;
use App\Exports\ReceivableExportView;
use App\Exports\InventoryExportView;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    public function salesReport(Request $request)
    {
        $input = ($request->all() == null ?  json_decode($request->getContent(), true) : $request->all() );  

        $orders = OrderDetail::whereStatus('paid');

        $keyword = $input['keyword'];        
        $range = isset($input['range']) ? $input['range'] : null;

        if ($input['day'] != null) {
            $date_time = $input['day'];
        } else if($input['week'] != null) {
            $date_time = $input['week'];
        } else if ($input['month'] != null) {
            $date_time = $input['month'];
        } else {
            $date_time = null;
        }
        
        if (! empty($keyword) || ! empty($date_time)) {
            $orders = OrderDetail::Search($keyword, $date_time, $range)->whereStatus('paid');            
        }

        $orders = $orders->orderBy('created_at', 'desc');

        $orders = $orders->paginate(10);

        return view('reports.sales', compact('orders'));
    }

    public function receivable(Request $request)
    {
        $input = ($request->all() == null ?  json_decode($request->getContent(), true) : $request->all() );  

        $orders = OrderDetail::whereStatus('payable');

        $keyword = $input['keyword'];        
        $range = isset($input['range']) ? $input['range'] : null;

        if ($input['day'] != null) {
            $date_time = $input['day'];
        } else if($input['week'] != null) {
            $date_time = $input['week'];
        } else if ($input['month'] != null) {
            $date_time = $input['month'];
        } else {
            $date_time = null;
        }
        
        if (! empty($keyword) || ! empty($date_time)) {
            $orders = OrderDetail::Search($keyword, $date_time, $range)->whereStatus('payable');            
        }

        $orders = $orders->orderBy('created_at', 'desc');

        $orders = $orders->paginate(10);

        return view('reports.receivable', compact('orders'));
    }

    public function inventory(Request $request)
    {
        $input = ($request->all() == null ?  json_decode($request->getContent(), true) : $request->all() );

        $items = new Item;

        if(! empty($input['keyword'])) {
            $items = $items->where('name', 'like', '%'. $input['keyword'] . '%');
        } else if (! empty($input['item'])) {
            $items = $items->where('name', 'like', '%'. $input['item'] . '%');
        }

        $items = $items->orderBy('updated_at', 'desc');

        $items = $items->paginate(10);

        return view('reports.inventory', compact('items'));
    }

    public function export()
    {
        return Excel::download(new SalesExport(), 'sales.xlsx');
    }

    public function export_view($id)
    {
        switch ($id) {
            case 'sales':
                    return Excel::download(new SalesExportView(), 'sales.xlsx');
                break;
            case 'receivable':
                    return Excel::download(new ReceivableExportView(), 'receivable.xlsx');
                break;
            case 'inventory':           
                    return Excel::download(new InventoryExportView(), 'inventory.xlsx');
                break;
            default:
                
                break;
        }
    }
}
