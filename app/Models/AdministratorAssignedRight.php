<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministratorAssignedRight extends Model
{
    use HasFactory;

    protected $fillable = [
        'right_id',
        'administrator_id',
        'is_deleted',
        'version'
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'is_deleted' => 'boolean',
    ];

    public function administrator()
    {
        return $this->belongsTo(Administrator::class, 'administrator_id', 'id');
    }

    public function right()
    {
        return $this->belongsTo(AdministratorRight::class, 'right_id', 'id');
    }
}
