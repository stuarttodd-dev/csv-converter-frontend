<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'system_id',
        'username',
        'userpass',
        'external',
        'forename',
        'surname',
        'email_address',
        'is_deleted',
        'version'
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'external' => 'boolean',
        'is_deleted' => 'boolean',
    ];

    public function assignedRights()
    {
        return $this->hasMany(AdministratorAssignedRight::class, 'administrator_id', 'id');
    }
}
