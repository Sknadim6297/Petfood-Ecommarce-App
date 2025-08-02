<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_title',
        'page_subtitle',
        'banner_image',
        'hero_title',
        'hero_description',
        'email_title',
        'email_address',
        'phone_title',
        'phone_number',
        'phone_subtitle',
        'hours_title',
        'working_hours',
        'working_days',
        'branch_title',
        'branch_description',
        'branch_placeholder',
        'office1_title',
        'office1_address',
        'office2_title',
        'office2_address',
        'form_title',
        'form_textarea_placeholder',
        'awards_title',
        'show_awards',
        'is_active'
    ];

    protected $casts = [
        'show_awards' => 'boolean',
        'is_active' => 'boolean'
    ];

    /**
     * Get the active contact settings
     */
    public static function getSettings()
    {
        return self::where('is_active', true)->first() ?? self::first() ?? new self();
    }
}
