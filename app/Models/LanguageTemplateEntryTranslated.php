<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageTemplateEntryTranslated extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_template_id',
        'language_term_id',
        'language_translation_id',
        'term',
        'version',
        'is_deleted',
    ];

    // The attributes that should be cast to native types.
    protected $casts = [
        'is_deleted' => 'boolean',
    ];
}
