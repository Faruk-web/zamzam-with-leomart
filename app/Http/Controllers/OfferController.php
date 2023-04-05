<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        return view('admin.offer.index', [
            'offers' => Offer::all()
        ]);
    }


    public function store(Request $request)
    {
        $offer = new Offer();
        $offer->offer_name = $request->offer_name;
        $offer->offer_description = $request->offer_description;
        $offer->offer_start = $request->offer_start;
        $offer->offer_end = $request->offer_end;
        $offer->status = $request->status;
        $offer->save();
        return redirect()->back()->with('success', 'Offer Add Successfully');
    }

    public function edit($id)
    {
        $offer = Offer::find($id);
        return response()->json([
            'status' => 200,
            'offer' => $offer
        ]);
    }

    public function update(Request $request)
    {
        $offer_id = $request->offer_id;
        $offer = Offer::find($offer_id);
        $offer->offer_name = $request->offer_name;
        $offer->offer_description = $request->offer_description;
        $offer->offer_start = $request->offer_start;
        $offer->offer_end = $request->offer_end;
        $offer->status = $request->status;
        $offer->update();
        return redirect()->back()->with('success', 'Offer Update Successfully');
    }

    public function destroy(Request $request)
    {
        $offer_id = $request->d_id;
        $offer = Offer::find($offer_id);
        $offer->delete();
        return redirect()->back()->with('success', 'Offer Delete Successfully');
    }
}
