<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Product extends Model
{
    use HasSlug;
    use HasFactory;

    protected $fillable = ['title', 'price', 'description', 'image', 'mime_type', 'created_by', 'updated_by', 'image_size'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
        ->generateSlugsFrom('title')
        ->saveSlugsTo('slug');
    }
    public function getRouteKeyName(){
        return 'slug';
    }

}
