<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pembeli_id' => ['required'],
            'total_bayar' => ['required']
        ]); 
        $dataTransaksi = [
            'penjual_id' => auth()->user()->id,
            'pembeli_id' => $request['pembeli_id'],
            'total_bayar' => $request['total_bayar']
        ];
        Transaksi::create($dataTransaksi);
        Order::where('id', $request['order_id'])
            ->update(['is_paid' => 1]);
        
        return response('Data has been added', 200);
    }
}
