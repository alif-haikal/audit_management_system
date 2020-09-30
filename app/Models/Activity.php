<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{                
    public $table = 'activities';

    public $fillable = [

		'id',
		'perkara',
		'perancangan',
		'perlaksanaan',
		'created_by',
		'created_at',
		'updated_at',
    ];

    public $casts = [
        'id' => 'integer',
		'perkara' => '',
		'perancangan' => '',
		'perlaksanaan' => '',
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
