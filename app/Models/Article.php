<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'has_toc',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'featured_image',
    ];

    protected $casts = [
        'has_toc' => 'boolean',
    ];
}