<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FailedJob extends Model
{                
    public $table = 'failed_jobs';

    public $fillable = [

		'id',
		'connection',
		'queue',
		'payload',
		'exception',
		'failed_at',
    ];

    public $casts = [
        'id' => 'integer',
		'connection' => '',
		'queue' => '',
		'payload' => '',
		'exception' => '',
		'failed_at' => 'datetime',
		
    ];

    public static $rules = [
		//
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    
}
