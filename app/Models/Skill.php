<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'data_tech',
        'proficiency',
        'sort_order',
        'is_active',
        'show_in_grid',
        'icon',
        'color',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'show_in_grid' => 'boolean',
        'proficiency' => 'integer',
    ];

    // Scope untuk skills yang aktif dan ditampilkan di grid
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForGrid($query)
    {
        return $query->where('show_in_grid', true);
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}