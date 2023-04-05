<?php

namespace App\Http\Controllers;

use App\Models\Refund;
use Illuminate\Http\Request;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RefundController extends Controller
{
    public function index()
    {
        if (Auth::user()->type == 1) {
            $refunds = Refund::all();
            return view('admin.refund.index', compact('refunds'));
        }
        else {
            Alert::toast('Something went wrong !', 'error');
            return back();
        }
    }
    public function edit($id)
    {
        if (Auth::user()->type == 1) {
            $refund = Refund::find($id);
            if (!is_null($refund)) {
                return view('admin.refund.edit', compact('refund'));
            }
            else {
                Alert::toast('Something went wrong !', 'error');
                return back();
            }
        }
        else {
            session()->flash('error','Something went wrong !');
            return back();
        }
    }
    public function refund(Request $request, $id)
    {
        $refund = Refund::findOrNew($id);
        $refund->name = $request->name;
        $refund->description = $request->description;
        $refund->save();
        return redirect()->back();
    }

    public function show()
    {
        return view('pages.return-and-refund', ['return' => Refund::find(1)]);
    }
}
