<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{                
    public $table = 'profiles';

    public $fillable = [

		'id',
		'ic',
		'created_at',
		'updated_at',
    ];

    public $casts = [
        'id' => 'integer',
		'ic' => 'string',
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
