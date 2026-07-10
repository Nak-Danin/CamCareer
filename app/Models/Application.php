<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class Application extends Model
{
    /** @use HasFactory<\Database\Factories\ApplicationFactory> */
    use HasFactory;
    protected $guarded = [];

    public function scopeRecievedApplications(Builder $query): Builder
    {
        $company_id = Auth::user()->company->company_id;
        return $query->where('company_id', $company_id);
    }
    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class, 'career_id', 'career_id');
    }
    public function seeker(): BelongsTo
    {
        return $this->belongsTo(CareerSeeker::class, 'seeker_id', 'seeker_id');
    }
    public function interview(): HasOne
    {
        return $this->hasOne(Interview::class, 'application_id', 'id');
    }
}
