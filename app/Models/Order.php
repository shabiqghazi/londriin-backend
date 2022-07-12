<?php

namespace App\Models;

use App\Models\Service\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id', 'user_id', 'address', 'weight', 'note', 'biaya', 'status', 'is_confirmed', 'is_paid'
    ];
    public function service(){
        return $this->belongsTo(Service::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
