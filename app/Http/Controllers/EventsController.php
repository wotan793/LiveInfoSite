<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Event;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('user_id', \Auth::id())->get();
        
        return view('events.index',[
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $event = new Event;
       return view('events.create', [
            'event' => $event,
       ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $this->validate($request, [
           'event_name' => 'required|max:191',
           'event_prefecture' => 'required|max:191',
           'event_venue' => 'required|max:191',
           'event_date' => 'required|date_format:Y-m-d',
           'event_starttime' => 'required|date_format:H:i',
           'event_artist' => 'required|max:191',
           'event_remarks' => 'required|max:191',
        ]);
        $request->user()->events()->create([
        'event_name' => $request->event_name,
        'event_prefecture' => $request->event_prefecture,
        'event_venue' => $request->event_venue,
        'event_date' => $request->event_date,
        'event_starttime' => $request->event_starttime,
        'event_artist' => $request->event_artist,
        'event_remarks' => $request->event_remarks,
        ]);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $event =  Event::find($id);

      return view('events.show', [
          'event' => $event,
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event =  Event::find($id);
        return view('events.edit', [
            'event' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'event_name' => 'required|max:191',
           'event_prefecture' => 'required|max:191',
           'event_venue' => 'required|max:191',
           'event_date' => 'required|date_format:Y-m-d',
           'event_starttime' => 'required|date_format:H:i',
           'event_artist' => 'required|max:191',
           'event_remarks' => 'required|max:191',
        ]);
        $event = Event::find($id);
        $event->event_name = $request->event_name;
        $event->event_prefecture = $request->event_prefecture;
        $event->event_venue = $request->event_venue;
        $event->event_date = $request->event_date;
        $event->event_starttime = $request->event_starttime;
        $event->event_artist = $request->event_artist;
        $event->event_remarks = $request->event_remarks;
        $event->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        if (\Auth::id() === $event->user_id) {
            $event->delete();
        }

        return redirect()->back();
    }
}