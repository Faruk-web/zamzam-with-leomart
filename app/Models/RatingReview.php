<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingReview extends Model
{
    use HasFactory;

    public function ratingReview()
    {
        return $this->belongsTo(Product::class,'product_id','id')->where('vendor_p', 1);
    }

    public function reviewImages()
    {
        return $this->hasMany(RatingImages::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
