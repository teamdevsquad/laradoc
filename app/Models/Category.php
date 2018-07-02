<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function scopeSearch($query, $search)
    {
        if (!$search)
            return $query;

        return $query->where('text', 'like', str_replace('*', '%', $search));
    }
}
