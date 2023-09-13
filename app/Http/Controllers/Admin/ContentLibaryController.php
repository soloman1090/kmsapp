<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentLibary;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContentLibaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $contents = null;
        if ($request->search) {

            $contents = ContentLibary::where('description', 'LIKE', "%{$request->search}%")->orWhere('slug', 'LIKE', "%{$request->search}%")->orWhere('category', 'LIKE', "%{$request->search}%")->orWhere('status', 'LIKE', "%{$request->search}%")->orWhere('extention', 'LIKE', "%{$request->search}%")->orderBy("created_at", 'desc')->paginate(12);
        } else {
            $contents = ContentLibary::where("category", "!=", "gallery")->where("created_at", "<", Carbon::now())->orderBy("created_at", 'desc')->paginate(12);
        }
         $priviledge = "admin";
        return view('admin.content-libary', ['contents' => $contents,"priviledge" => $priviledge,'page_title'=>"Content Management"]);
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
    public function store(Request $req)
    {
        $content = new ContentLibary;

        if ($req->file('resource_link') != null) {

            foreach ($req->file('resource_link') as $key=> $file) {

                $imageName = preg_replace('/\s+/', '', $file->getClientOriginalName());
                $file->move(public_path('uploads'), $imageName);
                $content->resource_link = $imageName;
                $content->extention = pathinfo('/uploads/' . $imageName)["extension"];
                $content->status = $req['status'];
                $content->category = $req['category'];
                $content->description = $req['description'];
                $content->slug = $req['slug'];
                $content->save();
            }


        } else {

            if ($req->status == "online" && $req->resource_url == "") {
                $req->session()->flash('error', 'Please provide file source');
                return redirect('admin/content-libary');
            }

            if ($req->status == "online" && $req->extention == "") {
                $req->session()->flash('error', 'Please select file extention');
                return redirect('admin/content-libary');
            }

            if ($req->status == "youtube" && $req->youtube_frame == "") {
                $req->session()->flash('error', 'Please Put the Embeded youtube code');
                return redirect('admin/content-libary');
            }

            if ($req->status == "online") {
                $content->extention = $req->extention;
                $content->resource_link = $req->resource_url;
            }

            if ($req->status == "youtube") {
                $content->extention = "mp4";
                $content->resource_link = $req->youtube_frame;
            }

            $content->status = $req['status'];
            $content->category = $req['category'];
            $content->description = $req['description'];
            $content->slug = $req['slug'];
            $content->save();
        }
        $req->session()->flash('success', 'Files Uploaded successfully');
        return redirect('admin/content-libary');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContentLibary  $contentLibary
     * @return \Illuminate\Http\Response
     */
    public function show(ContentLibary $contentLibary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContentLibary  $contentLibary
     * @return \Illuminate\Http\Response
     */
    public function edit(ContentLibary $contentLibary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContentLibary  $contentLibary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContentLibary $contentLibary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContentLibary  $contentLibary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ContentLibary $contentLibary)
    {
        ContentLibary::destroy($contentLibary->id);
        $request->session()->flash('success', 'Content  deleted!');
        return redirect('admin/content-libary');
    }
}
