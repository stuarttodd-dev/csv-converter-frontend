<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageTemplateEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_template_id',
        'hint',
        'term',
        'text',
        'is_deleted',
        'version',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'is_deleted' => 'boolean',
    ];
}
