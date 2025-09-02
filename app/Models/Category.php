<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Category extends Model
{
    //

    use Sluggable;

    protected $fillable = ["category","slug","status"];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'category'
            ]
        ];
    }

    public function products()
    {
        return $this->hasMany(product::class, 'category','id');
    }

    public function children()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

}
