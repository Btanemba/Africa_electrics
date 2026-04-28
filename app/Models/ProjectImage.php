<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectImage extends Model
{
    use CrudTrait;

    protected $fillable = [
        'project_id',
        'image_path',
        'sort_order',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}