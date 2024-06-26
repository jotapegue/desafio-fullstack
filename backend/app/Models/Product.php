<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'due_in',
        'image',
        'category_id',
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeCategory($query, $category_id)
    {
        return $query->where('category_id', $category_id);
    }

    public function scopeLikeName($query, $name)
    {
        return $query->where('name', 'like', "%{$name}%");
    }
}
