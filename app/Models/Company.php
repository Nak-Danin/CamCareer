<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Builder;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;
    protected $primaryKey = 'company_id';
    protected $guarded = [];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function careers(): HasMany
    {
        return $this->hasMany(Career::class, 'company_id', 'company_id');
    }
    public function applications(): HasManyThrough
    {
        return $this->HasManyThrough(Application::class, Career::class, 'company_id', 'career_id', 'company_id', 'career_id');
    }
    public function scopeTopCompanies(Builder $query): Builder
    {
        return $query->withCount('careers')->orderByDesc('careers_count')->limit(3);
    }
}
