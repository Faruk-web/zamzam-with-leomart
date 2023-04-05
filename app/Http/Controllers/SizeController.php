<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function store(Request $request)
    {
        if ($this->validate($request, [
            'name' => 'required|unique:sizes,name'
        ]))
        {
            $size = new Size();
            $size->name = $request->name;
            $size->status = $request->status;
            $size->save();
            return redirect()->back()->with('success', 'Size Add Successfull');
        }
        else
        {
            return redirect()->back()->with('error', 'Size Name already exits');
        }
    }

    public function edit($id)
    {
        $size = Size::find($id);
        return response()->json([
            'status' => 200,
            'size' => $size
        ]);
    }

    public function update(Request $request)
    {
        $size_id = $request->size_id;
        $size = Size::find($size_id);
        $size->name = $request->name;
        $size->status = $request->status;
        $size->save();
        return redirect()->back()->with('success', 'Size Delete Successfully');
    }

    public function destroy(Request $request)
    {
        $sd_id = $request->sd_id;
        $size = Size::find($sd_id);
        $size->delete();
        return redirect()->back()->with('success', 'Size Delete Successfully');
    }
}
