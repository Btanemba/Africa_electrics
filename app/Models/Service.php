<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use CrudTrait;

    private const ICONS = [
        'switchboard' => [
            'label' => 'Switchboard',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>',
        ],
        'circuit' => [
            'label' => 'Circuit Board',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a1 1 0 00-1 1v2m0 8v2a1 1 0 001 1h2m8 0h2a1 1 0 001-1v-2m0-8V6a1 1 0 00-1-1h-2M9 9h6v6H9V9zm-4 3h4m6 0h4M12 5v4m0 6v4"/>',
        ],
        'development' => [
            'label' => 'Development',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>',
        ],
        'research' => [
            'label' => 'Research',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>',
        ],
        'solar' => [
            'label' => 'Solar',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v2m6.364.636l-1.414 1.414M20 12h2m-3.636 6.364l-1.414-1.414M12 20v2m-6.364-3.636l1.414-1.414M2 12h2m3.636-6.364l1.414 1.414M8 12a4 4 0 118 0 4 4 0 01-8 0z"/>',
        ],
        'battery' => [
            'label' => 'Battery Storage',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2V9a2 2 0 012-2zm10-2v2M9 10v4m2-2H7m7-2l-2 4m4-4l-2 4"/>',
        ],
        'power' => [
            'label' => 'Power',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 2L6 14h5l-1 8 7-12h-5l1-8z"/>',
        ],
        'wiring' => [
            'label' => 'Wiring',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6a2 2 0 114 0v2a2 2 0 11-4 0V6zm8 10a2 2 0 114 0v2a2 2 0 11-4 0v-2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 7h2a4 4 0 014 4v3m-6 0H8a4 4 0 01-4-4V9"/>',
        ],
        'transformer' => [
            'label' => 'Transformer',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7c-1.5 0-3 1.5-3 3s1.5 3 3 3m0-6c1.5 0 3 1.5 3 3s-1.5 3-3 3m10-6c-1.5 0-3 1.5-3 3s1.5 3 3 3m0-6c1.5 0 3 1.5 3 3s-1.5 3-3 3M10 10h4m-4 4h4M8 13v4m8-10v4"/>',
        ],
        'generator' => [
            'label' => 'Generator',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 9a2 2 0 012-2h8a2 2 0 012 2v6a2 2 0 01-2 2H7a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 13h3m2 0h1m-4-3v6M17 11h2m-2 4h2M7 7l1-2h6l1 2"/>',
        ],
        'grid' => [
            'label' => 'Power Grid',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l4 6h-2l2 10h-4l-2-6-2 6H4L6 9H4l8-6z"/>',
        ],
        'automation' => [
            'label' => 'Automation',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V3m0 18v-3m6-6h3M3 12h3m11.314 5.314l2.121 2.121M4.565 4.565l2.121 2.121m10.628-2.121l-2.121 2.121M6.686 17.314l-2.121 2.121"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8a4 4 0 100 8 4 4 0 000-8z"/>',
        ],
        'ev-charging' => [
            'label' => 'EV Charging',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6a2 2 0 012 2v8a2 2 0 01-2 2H9a2 2 0 01-2-2V9a2 2 0 012-2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 10l-1 3h2l-1 3 3-4h-2l1-2M17 10h1a2 2 0 012 2v2m-1-4v4"/>',
        ],
        'safety' => [
            'label' => 'Safety',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3l7 4v5c0 5-3.5 8-7 9-3.5-1-7-4-7-9V7l7-4z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.5 12.5l1.5 1.5 3.5-4"/>',
        ],
        'maintenance' => [
            'label' => 'Maintenance',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.7 6.3a3 3 0 104.243 4.243l-4.95 4.95a2 2 0 01-2.829 0l-1.414-1.414a2 2 0 010-2.829l4.95-4.95z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17l-2 2m0 0l-1-1m1 1l1 1"/>',
        ],
        'inspection' => [
            'label' => 'Inspection',
            'svg' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4h6a2 2 0 012 2v10a2 2 0 01-2 2h-6a2 2 0 01-2-2V6a2 2 0 012-2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 8H6a2 2 0 00-2 2v6a2 2 0 002 2h6"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 9h4m-4 3h4m-4 3h2"/>',
        ],
    ];

    protected $fillable = [
        'title',
        'description',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    public static function iconOptions(): array
    {
        return collect(self::ICONS)
            ->mapWithKeys(fn (array $icon, string $key) => [$key => $icon['label']])
            ->all();
    }

    public function getIconMarkupAttribute(): string
    {
        return self::ICONS[$this->icon]['svg'] ?? self::ICONS['switchboard']['svg'];
    }
}