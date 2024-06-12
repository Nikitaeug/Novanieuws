<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaar extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'news_id',
    ];

    public function news()
    {
        return $this->belongsTo(Nieuws::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $table = 'comments';

}
