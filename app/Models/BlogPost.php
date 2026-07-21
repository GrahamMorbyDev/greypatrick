<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[Fillable(['title', 'slug', 'image', 'post', 'author', 'excerpt', 'is_published', 'published_at'])]
class BlogPost extends Model
{
    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (BlogPost $post) {
            if ($post->slug === null || $post->slug === '') {
                $post->slug = Str::slug($post->title);
            }
        });
    }
}
