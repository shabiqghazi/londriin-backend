<?php

namespace App\Models\Service;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'user_id', 'rate', 'comment'];

    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getRatingsByService($service_id){
        // return DB::table('ratings')
        //         ->join('users', 'ratings.user_id', '=', 'users.id', 'right')
        //         ->where('service_id', '=', $service_id)
        //         ->get();
    }
}
