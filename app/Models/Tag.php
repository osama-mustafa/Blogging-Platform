<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    protected function name() : Attribute 
    {
        return Attribute::make(
            get: fn(string $value) => strtolower($value),
            set: fn(string $value) => strtolower($value)
        );
    }
}
