<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelHasPermission extends Model
{                
    public $table = 'model_has_permissions';

    public $fillable = [

		'permission_id',
		'model_type',
		'model_id',
    ];

    public $casts = [
        'permission_id' => 'integer',
		'model_type' => 'string',
		'model_id' => 'integer',
		
    ];

    public static $rules = [
		//
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    
}
