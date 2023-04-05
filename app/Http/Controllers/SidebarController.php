<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Sidebar;
use Illuminate\Http\Request;
use Auth;
use Alert;
use Image;
use File;
class SidebarController extends Controller
{
    //Create Sidebar
    public function create()
    {
        
        if (Auth::user()->type == 1) {
            $sidebars = Sidebar::orderBy('id', 'DESC')->get();
            return view('admin.sidebar.index', compact('sidebars'));
        }
        else{
            Alert::toast('Access Denied !', 'error');
        }
    }
    //sidebar store
    public function sidebarStore(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'main_sidebar' => 'required|max:255',
        ]);
        $sidebars = new Sidebar;
        $sidebars->main_sidebar = $request->main_sidebar;
        $sidebars->childe_sidebar = $request->childe_sidebar;
        // image save
        $sidebars->save();
        Alert::toast('One sidebars Added !', 'success');
        return redirect()->route('admin.sidebar.create');
    }
}
