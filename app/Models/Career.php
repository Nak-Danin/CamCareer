<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Career extends Model
{
    /** @use HasFactory<\Database\Factories\CareerFactory> */
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'career_id';
    protected $casts = [
        'responsibilities' => 'array',
        'benefits' => 'array',
        'requirements' => 'array',
    ];
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'career_id', 'career_id');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    public function scopeAvailableCareers(Builder $query): Builder
    {
        return $query->where('status', 'available');
    }
    public function scopeCompanyCareers(Builder $query): Builder
    {
        $company = Auth::user()->company->company_id;
        return $query->where('company_id', $company);
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($career) {
            $slug = Str::slug($career->title);
            // Avoid duplication bug: If "software-engineer" exists, make it "software-engineer-1"
            $count = static::where('slug', 'LIKE', "{$slug}%")->count();
            $career->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
}
