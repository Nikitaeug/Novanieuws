<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nieuws extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'news';

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }
    public function commentaren()
    {
    return $this->hasMany(Commentaar::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'news_tags', 'news_id', 'tag_id');    }
    
}
