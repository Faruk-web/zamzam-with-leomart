<?php

namespace App\Http\Controllers;

use App\Models\RatingImages;
use App\Models\RatingReview;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;
use Alert;
use Validator;

class RatingReviewController extends Controller
{


    public function getImageUrl($request)
    {
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $directory = 'images/rating/';
        $image->move($directory, $imageName);
        $imageUrl = $directory.$imageName;
        return $imageUrl;
    }
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gallery' => 'image|max:2048',
            'gallery.image' => 'The file must be an image file (JPEG, PNG, BMP, GIF, or SVG).',
            'gallery.max' => 'The maximum file size allowed is 2MB.',
        ]);
//        return $request->all();
        if (Auth::user())
        {
            $rating = new RatingReview();
            $rating->user_id = $request->user_id;
            $rating->product_id = $request->product_id;
            $rating->name = $request->name;
            $rating->email = $request->email;
            $rating->rating = $request->rating;
            $rating->review = $request->review;
            $rating->save();
        }
        if ($request->gallery)
        {
            if (count($request->gallery) > 0) {
                $i = 0;
                foreach ($request->gallery as $gallery) {
                    $imageName = time() . $i . '.' . $gallery->getClientOriginalExtension();
                    $directory = 'images/review/gallery/';
                    $gallery->move($directory, $imageName);
                    $galleryUrl = $directory . $imageName;

                    $gallery = new RatingImages();
                    $gallery->images = $galleryUrl;
                    $gallery->rating_review_id = $rating->id;
                    $gallery->save();
                    $i = $i + 1;
                }
            }
        }
        Alert::success('Thank you For your rating and review !', '');
        return redirect()->back();
    }

    public function show()
    {
        $ratings = Product::with('ratingReview')->where('vendor_p',1)->get();
        return view('pages.vendor.rating-review.show', compact('ratings'));
    }

    public function delete($id)
    {
        $rating = RatingReview::find($id);
        foreach ($rating->reviewImages as $reviewImage)
        {
            if (file_exists($reviewImage->images))
            {
                unlink($reviewImage->images);
            }
            $reviewImage->delete();
        }
        $rating->delete();
        return redirect()->back()->with('success', 'Rating and raview delete successfull');
    }
}
