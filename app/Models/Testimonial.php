<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'role_or_company',
        'avatar',
        'message',
        'rating',
        'status',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];

    // Scope untuk mengambil testimoni yang sudah disetujui saja
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}