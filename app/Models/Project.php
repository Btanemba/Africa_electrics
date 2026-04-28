<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use CrudTrait;

    private const CATEGORIES = [
        'solar' => 'Solar',
        'industrial' => 'Industrial',
        'commercial' => 'Commercial',
        'residential' => 'Residential',
        'other' => 'Other',
    ];

    protected $fillable = [
        'title',
        'category',
        'summary',
        'image',
        'location',
        'project_year',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'project_year' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderByDesc('project_year')->orderBy('title');
    }

    public static function categoryOptions(): array
    {
        return self::CATEGORIES;
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order')->orderBy('id');
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? ucfirst((string) $this->category);
    }

    public function setImageAttribute($value): void
    {
        $attributeName = 'image';
        $disk = 'public';
        $destinationPath = 'projects';

        if ($value && is_object($value) && method_exists($value, 'store')) {
            if ($this->{$attributeName}) {
                Storage::disk($disk)->delete($this->{$attributeName});
            }

            $this->attributes[$attributeName] = $value->store($destinationPath, $disk);

            return;
        }

        if ($value === null) {
            if ($this->{$attributeName}) {
                Storage::disk($disk)->delete($this->{$attributeName});
            }

            $this->attributes[$attributeName] = null;
        }
    }

    public function getImageUrlAttribute(): ?string
    {
        $image = $this->relationLoaded('images')
            ? $this->images->first()
            : $this->images()->first();

        if ($image?->image_path) {
            return asset('storage/' . $image->image_path);
        }

        if (! $this->image) {
            return null;
        }

        return asset('storage/' . $this->image);
    }
}
