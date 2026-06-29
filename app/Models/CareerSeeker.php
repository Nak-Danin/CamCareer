<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CareerSeeker extends Model
{
    /** @use HasFactory<\Database\Factories\CareerSeekerFactory> */
    use HasFactory;
    protected $primaryKey = 'seeker_id';
    protected $guarded = [];
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'seeker_id', 'seeker_id');
    }
}
