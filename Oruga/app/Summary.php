<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    public function scopeWhereSearch($query, $word)
    {
        $query->where('word', 'LIKE', "%{$word}%");
    }
}
