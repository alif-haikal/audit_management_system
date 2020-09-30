<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{                
    public $table = 'process';

    public $fillable = [

		'id',
		'process',
		'created_by',
		'created_at',
		'updated_at',
    ];

    public $casts = [
        'id' => 'integer',
		'process' => '',
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
