<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{                
    public $table = 'permissions';

    public $fillable = [

		'id',
		'name',
		'guard_name',
		'created_at',
		'updated_at',
    ];

    public $casts = [
        'id' => 'integer',
		'name' => 'string',
		'guard_name' => 'string',
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
