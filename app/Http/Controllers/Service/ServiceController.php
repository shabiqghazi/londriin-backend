<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Service\Service;
use App\Models\Service\ServiceCategory;
use App\Models\User;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\PostDec;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'address' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'category_id' => ['required']
        ]); 
        $dataService = [
            'name' => $request['name'],
            'slug' => Str::of($request['name'])->slug('-'),
            'address' => $request['address'],
            'description' => $request['description'],
            'price' => $request['price'],
            'category_id' => $request['category_id'],
            'user_id' => auth()->user()->id
        ];
        Service::create($dataService);
        
        return response('Data has been added', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function checkService()
    {
        $service = new Service();
        return response()->json($service->getServiceByUser());
    }
    public function getAllServices(){
        return response()->json(Service::all());
    }
    public function getService(Service $service){
        return response()->json($service);
    }
    public function getServiceByPenjual(){
        return DB::table('services')->where('user_id','=',Auth::user()->id)->first();
    }
    public function getServicesByKeyword($keyword){
        return response()->json(DB::table('services')
                    ->where('name', 'like', "%$keyword%")
                    ->orWhere('address', 'like', "%$keyword%")
                    ->get());
    }
    
}
