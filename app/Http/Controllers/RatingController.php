<?php

namespace App\Http\Controllers;

use App\Models\Service\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => ['required'],
            'rate' => ['required'],
            'comment' => ['required'],
        ]); 
        $dataRating = [
            'service_id' => $request['service_id'],
            'user_id' => Auth::user()->id,
            'rate' => $request['rate'],
            'comment' => $request['comment'],
        ];
        Rating::create($dataRating);
        
        return response('Data has been added', 200);
    }

    public function getCommentByService($service_id){
        return response()->json(Rating::with('user')->where('service_id', '=', $service_id)->get());
    }
}
