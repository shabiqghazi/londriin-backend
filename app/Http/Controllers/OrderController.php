<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => ['required'],
            'address' => ['required'],
            'weight' => ['required'],
            'note' => ['required'],
            'biaya' => ['required']
        ]); 
        $dataOrder = [
            'service_id' => $request['service_id'],
            'user_id' => Auth::user()->id,
            'address' => $request['address'],
            'weight' => $request['weight'],
            'note' => $request['note'],
            'biaya' => $request['biaya'],
            'status' => 1,
            'is_confirmed' => 0,
            'is_paid' => 0
        ];
        Order::create($dataOrder);
        
        return response('Data has been added', 200);
    }
    public function getOrder($id){
        return response()->json(Order::with('user')->where('id', '=', $id)->first(), 200);
    }
    public function getOrders(){
        $user_id = Auth::user()->id;
        $service_id = DB::table('services')->where('user_id', '=', $user_id)->first()->id;
        return response()->json(Order::with('user')->where('service_id', '=', $service_id)->get());
    }
    public function changeStatus(Request $request){
        $affected = DB::table('orders')
                    ->where('id', '=', $request['order_id'])
                    ->update(['status' => $request['status']]);
        return ($affected > 0 ? response('Status berhasil diubah', 200) : response('Gagal', 401));
    }
    public function confirmOrder(Request $request){
        $affected = DB::table('orders')
                    ->where('id', '=', $request['order_id'])
                    ->update(['is_confirmed' => 1]);
        
        return ($affected > 0 ? response('Order dikonfirmasi', 200) : response('Gagal', 401));
    }
    public function getOrdersCount(){
        $dijemput = Order::where('user_id', Auth::user()->id)
                        ->where('status', 1)
                        ->count();
        $diproses = Order::where('user_id', Auth::user()->id)
                        ->where('status', 2)
                        ->count();
        $dikirim = Order::where('user_id', Auth::user()->id)
                        ->where('status', 3)
                        ->count();
        $selesai = Order::where('user_id', Auth::user()->id)
                        ->where('status', 4)
                        ->count();
        return response()->json([
            'dijemput' => $dijemput,
            'diproses' => $diproses,
            'dikirim' => $dikirim,
            'selesai' => $selesai
        ], 200);
    }
}
