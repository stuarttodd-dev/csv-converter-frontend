<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRight extends Model
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

    public function rightGroup(): BelongsTo
    {
        return $this->belongsTo(UserRightGroup::class, 'right_group_id');
    }

}
