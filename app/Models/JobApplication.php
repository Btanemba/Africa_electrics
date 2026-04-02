<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    use CrudTrait;

    protected $fillable = [
        'job_listing_id',
        'full_name',
        'email',
        'phone',
        'cover_letter',
        'resume_path',
        'cover_letter_path',
        'status',
    ];

    public function jobListing(): BelongsTo
    {
        return $this->belongsTo(JobListing::class);
    }
}
