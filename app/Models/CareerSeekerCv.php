<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CareerSeekerCv extends Model
{
    protected $primaryKey = 'cv_id';
    protected $guarded = [];

    public function seeker(): BelongsTo
    {
        return $this->belongsTo(CareerSeeker::class, 'seeker_id', 'seeker_id');
    }
}
