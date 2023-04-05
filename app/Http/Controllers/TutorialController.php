<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TutorialController extends Controller
{
    public function index()
    {
        return view('admin.tutorial.index', ['tutorials' => Tutorial::all()]);
    }


    public function create()
    {
        return view('admin.tutorial.create');
    }

    public function getFileUrl($request)
    {
        $slug = Str::slug($request->type);
        $video = $request->file('video');
        $videoName = $slug.'-'.time().'.'.$video->getClientOriginalExtension();
        $directory = 'admin/tutorial/'.$slug.'/';
        $video->move($directory,$videoName);
        $videoUrl = $directory.$videoName;
        return $videoUrl;
    }

    public function store(Request $request)
    {
        $tutorial = new Tutorial();
        $tutorial->type = $request->type;
        $tutorial->title = $request->title;
        $tutorial->description = $request->description;
        $tutorial->video = $this->getFileUrl($request);
        $tutorial->status = $request->status;
        $tutorial->save();
        return redirect()->route('tutorial.index')->with('success', ''.$request->type.'Add Tutorial Create Successfull');
    }

    public function edit($id)
    {
        return view('admin.tutorial.edit', ['tutorial' => Tutorial::find($id)]);
    }

    public function update(Request $request, $id)
    {
        $tutorial = Tutorial::find($id);
        if ($request->file('video'))
        {
            if (file_exists($tutorial->video))
            {
                unlink($tutorial->video);
            }
            $videoUrl = $this->getFileUrl($request);
        }
        else
        {
            $videoUrl = $tutorial->video;
        }
        $tutorial->type = $request->type;
        $tutorial->title = $request->title;
        $tutorial->description = $request->description;
        $tutorial->video = $videoUrl;
        $tutorial->status = $request->status;
        $tutorial->save();
        return redirect()->route('tutorial.index')->with('success', ''.$request->type.'Add Tutorial Update Successfull');
    }


    public function destroy($id)
    {
        $tutorial = Tutorial::find($id);
        if (file_exists($tutorial->video))
        {
            unlink($tutorial->video);
        }
        $tutorial->delete();
        return redirect()->route('tutorial.index')->with('success', ''.$tutorial->type.'Add Tutorial Delete Successfull');
    }

}
