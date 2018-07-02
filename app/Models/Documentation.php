<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($doc) {
            $doc->slug = str_slug( $doc->title );
        });

        static::updating(function ($doc) {
            $doc->slug = str_slug( $doc->title );
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearch($query, $search)
    {
        if (!$search)
            return $query;

        return $query->where('title', 'like', str_replace('*', '%', $search));
    }
}
