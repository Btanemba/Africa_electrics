<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class TeamMember extends Model
{
    use CrudTrait;

    protected $fillable = ['name', 'role', 'bio', 'photo', 'sort_order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function setPhotoAttribute($value)
    {
        $attribute_name = 'photo';
        $disk = 'public';
        $destination_path = 'team-members';

        // If a new file was uploaded
        if ($value && is_object($value) && method_exists($value, 'store')) {
            // Delete old photo if exists
            if ($this->{$attribute_name}) {
                Storage::disk($disk)->delete($this->{$attribute_name});
            }
            $this->attributes[$attribute_name] = $value->store($destination_path, $disk);
            return;
        }

        // If value is null (photo removed)
        if ($value == null) {
            if ($this->{$attribute_name}) {
                Storage::disk($disk)->delete($this->{$attribute_name});
            }
            $this->attributes[$attribute_name] = null;
            return;
        }

        // Keep existing value (string path, no change)
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return null;
    }
}
