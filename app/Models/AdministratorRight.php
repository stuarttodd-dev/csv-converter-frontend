<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministratorRight extends Model
{
    use HasFactory;

    protected $fillable = [
        'right_name',
        'right_display_name',
        'right_group_id',
        'icon_class',
        'is_deleted',
        'version'
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'is_deleted' => 'boolean',
    ];

    public function assignedRights()
    {
        return $this->hasMany(AdministratorAssignedRight::class, 'right_id', 'id');
    }

}
