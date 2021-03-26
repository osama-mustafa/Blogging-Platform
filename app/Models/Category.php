<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class)->orderBy('created_at', 'DESC');
    }
    
}
