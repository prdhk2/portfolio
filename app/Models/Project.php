<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'technology',
        'project_url',
        'code_url',
        'meta',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope untuk projects yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByTechnology($query, $technology)
    {
        return $query->where('technology', $technology);
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }
}