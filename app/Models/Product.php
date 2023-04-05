<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WisdomDiala\Countrypkg\Models\Country;

class Product extends Model
{

    public function countPositiveRatings()
    {
        return RatingReview::where('product_id', $this->id)->where('rating', 5)->count();
    }

    use HasFactory;
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Category:: class);
    }
    public function subCategory()
    {
        return $this->belongsTo(Category:: class)->where('parent_id',1);
    }

    public function brand()
    {
        return $this->belongsTo(Brand:: class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function color()
    {
        return $this->belongsTo(Color:: class);
    }
    public function country()
    {
        return $this->belongsTo(Country:: class);
    }
    public function origin_country()
    {
        return $this->belongsTo(Country:: class);
    }
    public function cross_border_country()
    {
        return $this->belongsTo(Country:: class);
    }

    public function size()
    {
        return $this->belongsTo(Size:: class);
    }

    public function variation()
    {
        return $this->hasMany(ProductVariation:: class);
    }

    public function variationColor()
    {
        return $this->hasMany(ProductVariation:: class, 'color_id');
    }

    public function product_image()
    {
        return $this->hasMany(ProductImage:: class);
    }
    public function package()
    {
        return $this->hasMany(Package:: class);
    }
    public function ratingReview()
    {
        return $this->hasMany(RatingReview::class);
    }
    public function reviews()
    {
        return $this->hasMany(RatingReview::class,'product_id');
    }

}
