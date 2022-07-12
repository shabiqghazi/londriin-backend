<?php

namespace App\Models\Service;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug','address','description','price', 'user_id', 'category_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getServiceByUser(){
        return DB::table('services')->where('user_id', '=', Auth::user()->id)->count();
    }
    public function getServie($id){
        return DB::table('services')->where('id', '=', $id)->first();
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
}
