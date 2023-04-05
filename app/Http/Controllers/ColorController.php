<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function store(Request $request)
    {
        if ($this->validate($request, [
            'name' => 'required|unique:colors,name'
        ]))
        {
            $color = new Color();
            $color->name = $request->name;
            $color->code = $request->code;
            $color->status = $request->status;
            $color->save();
            return redirect()->back()->with('success', 'Color Add Successfull');
        }
        else
        {
            return redirect()->back()->with('error', 'Color Name already exits');
        }
    }

    public function edit($id)
    {
        $color = Color::find($id);
        return response()->json([
            'status' => 200,
            'color' => $color
        ]);
    }

    public function update(Request $request)
    {
        $color_id = $request->color_id;
        $color = Color::find($color_id);
        $color->name = $request->name;
        $color->code = $request->code;
        $color->status = $request->status;
        $color->save();
        return redirect()->back()->with('success', 'Color Delete Successfully');
    }

    public function destroy(Request $request)
    {
        $d_id = $request->d_id;
        $color = Color::find($d_id);
        $color->delete();
        return redirect()->back()->with('success', 'Color Delete Successfully');
    }
}
