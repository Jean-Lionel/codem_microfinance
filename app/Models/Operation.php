<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Operation extends ParentModel
{
    //

  //   "motif" => "ddddddddddd"
  // "piece_number" => "dddddddddd"
    protected $fillable = ['compte_name','operer_par','montant','type_operation',
    'user_id','cni', 'motif','piece_number'
    ];

    public $sortable = ['compte_name','operer_par','montant','type_operation',
    'user_id','cni','created_at','motif','piece_number'
    ];

    public static function boot()
    {
    	parent::boot();

    	self::creating(function($model){

            $model->user_id = Auth::user()->id;

            $model->montant = abs($model->montant);


            });

    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


}