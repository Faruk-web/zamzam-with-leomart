<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Auth;
use File;
use Image;
use Alert;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type == 1) {
            $sliders = Slider::all();
            return view('admin.slider.index', compact('sliders'));
        }
        else {
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'position' => 'required|integer',
            'image' => 'image',
            'link' => 'nullable',
        ]);

        $slider = Slider::find($request->position);
        if (!is_null($slider)) {
            // image save
            if ($request->image){
                if (File::exists('images/slider/'.$slider->image)){
                    File::delete('images/slider/'.$slider->image);
                }
                $image = $request->file('image');
                $img = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/slider/'. $img);
                Image::make($image)->save($location);
                $slider->image = $img;
            }
            if ($request->link != null) {
                $slider->link = $request->link;
            }

            $slider->save();
            Alert::toast('Slide has been changed', 'success');
            return redirect()->route('slider.index');
        }
        else {
            session()->flash('error','Something went wrong!');
            return redirect()->route('admin.slider');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        //
    }
}
