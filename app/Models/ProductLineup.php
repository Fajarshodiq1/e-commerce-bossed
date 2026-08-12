<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProductLineup extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sort_order' => 'integer',
    ];

    // Pastikan price selalu null kalau kosong, bukan string ''
    protected function price(): Attribute
    {
        return Attribute::make(
            set: fn($value) => $value === '' || $value === null ? null : $value,
        );
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active')->orderBy('sort_order');
    }
}