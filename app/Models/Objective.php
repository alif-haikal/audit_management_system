<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Objective extends Model
{                
    public $table = 'objectives';

    public $fillable = [

		'id',
		'objective',
		'created_by',
		'created_at',
		'updated_at',
    ];

    public $casts = [
        'id' => 'integer',
		'objective' => '',
		'created_by' => 'integer',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
		
    ];

    public static $rules = [
		//
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    
}
