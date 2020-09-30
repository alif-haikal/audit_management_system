<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleHasPermission extends Model
{                
    public $table = 'role_has_permissions';

    public $fillable = [

		'permission_id',
		'role_id',
    ];

    public $casts = [
        'permission_id' => 'integer',
		'role_id' => 'integer',
		
    ];

    public static $rules = [
		//
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    
}
