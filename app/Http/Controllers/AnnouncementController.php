<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Session;

class AnnouncementController extends Controller
{

    public function __construct(){

        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $announcements = Announcement::paginate(5);

        return view('announcement.index',compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('announcement.create');
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
        $this->validate($request, [

            'note' => 'bail|required|unique:announcements|max:255',
        ]);

        $announcement = new Announcement();

        $announcement->user_id = Auth::user()->id;

        $announcement->note = $request->note;

        $announcement->active = 1;

        if($announcement->save()){

            Session::flash('success', 'Announcement successfully added!');

            return redirect('/announcement');

        }

        Session::flash('error', 'Announcement failed to add!');

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        //
        return view('announcement.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        //
        return view('announcement.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $announcement)
    {
        //
        
         $this->validate($request, [
            'note' => 'bail|required|max:255',
        ]);

        
        $update = Announcement::findOrFail($announcement);

            //$update = Announcement::findOrFail($announcement);

            
            $update->note = $request->note;

            $update->active = $request->active;
           
            if($update->save()){

                Session::flash('success', 'Announcement with id: '.$announcement.' successfully updated!');

                return redirect('/announcement');

            }

            Session::flash('error', 'Announcement failed to update!');

            return redirect()->back();

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy($announcement)
    {
        //
        $delete =  Announcement::find($announcement)->delete();
        Session::flash('success', 'Announcement with id: '.$announcement.' successfully deleted!');
        return back();
    }
}
