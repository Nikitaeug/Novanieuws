<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function nieuws()
{
    return $this->belongsToMany(Nieuws::class, 'news_tags', 'tag_id', 'news_id');
}
}
