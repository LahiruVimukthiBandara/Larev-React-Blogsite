<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model {
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'body',
        'active',
        'featured',
        'published_date',
        'user_id',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo( User::class );
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany( Category::class, 'category_post' );
    }

    public function comments():HasMany {
        return $this->hasMany( Comment::class );
    }
}
