<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $primaryKey = 'category_id';
    protected $guarded = [];
    public function careers(): HasMany
    {
        return $this->hasMany(Career::class, 'category_id', 'category_id');
    }
}
