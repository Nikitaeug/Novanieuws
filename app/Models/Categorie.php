<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected static function booted() // what does it do? When a category is deleted, the associated news articles are updated to have the "Uncategorized" category.
    {
        static::deleting(function ($category) {
            // Get the "Uncategorized" category
            $uncategorized = Categorie::where('title', 'Uncategorized')->first();
        
            // Check if the "Uncategorized" category exists
            if ($uncategorized) {
                // Update the category_id of associated news articles
                Nieuws::where('category_id', $category->id)->update(['category_id' => $uncategorized->id]);
            } else {
                // Handle the case where the "Uncategorized" category does not exist
                // For example, you could throw an exception
                throw new \Exception('The "Uncategorized" category does not exist.');
            }
        });
    }
}
