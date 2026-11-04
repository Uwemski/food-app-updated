<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Laravel\Scout\Searchable;


class Product extends Model
{
    //
    use searchable;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'quantity',
        'image',
        'is_available'
    ];


    protected $casts = [
        'is_available' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
