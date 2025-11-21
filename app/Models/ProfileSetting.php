<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProfileSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'value' => 'string',
    ];

    // Helper method untuk mengambil setting
    public static function getValue($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    // Helper method untuk update setting
    public static function setValue($key, $value)
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    // Cast value berdasarkan type
    protected function castedValue(): Attribute
    {
        return Attribute::make(
            get: function () {
                return match($this->type) {
                    'json' => json_decode($this->value, true),
                    'boolean' => (bool) $this->value,
                    'number' => (int) $this->value,
                    default => $this->value,
                };
            }
        );
    }
}