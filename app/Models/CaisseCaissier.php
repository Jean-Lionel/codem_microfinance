<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CaisseCaissier extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];

    public function user(){
    	return $this->belongsTo(User::class,'user_id','id');
    }
}
