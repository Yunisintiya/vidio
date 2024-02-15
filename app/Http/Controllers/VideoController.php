<?php

namespace App\Http\Controllers;

use App\Models\video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::latest()->paginate(5);
        return view('video.index', compact('videos'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,jpeg,png,jpg,gif|max:10048',
        ]);

        $videos = new Video;

        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $destinationPath = 'video/';
            $video->move($destinationPath, $videoName);
            $videos->video = $videoName;
        }

        $videos->created_by = $request->created_by;
        $videos->caption = $request->caption;
        $videos->save();

        return redirect()->route('vidio.index')->with('success', 'Video berhasil di unggah!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        try {
            // Temukan video berdasarkan ID
            $video = Video::findOrFail($video->id);

            // Hapus video dari database
            $video->delete();

            return redirect()->route('vidio.index')->with('success', 'Video berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus Video: ' . $e->getMessage());
        }
    }
}
