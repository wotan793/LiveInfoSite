<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
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
        $events = Event::where('user_id', \Auth::id())->orderBy('event_date', 'asc')->paginate(10);
        
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
            'event_imageUrl' => 'image',
        ]);
        
        if ($request->event_imageUrl !==NULL){
            $image = $request->file('event_imageUrl');
                    /**
             * 自動生成されたファイル名が付与されてS3に保存される。
             * 第三引数に'public'を付与しないと外部からアクセスできないので注意。
             */
            $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        
            /* ファイルパスから参照するURLを生成する */
            $request->event_imageUrl = Storage::disk('s3')->url($path);
        }        
        $request->user()->events()->create([
            'event_name' => $request->event_name,
            'event_prefecture' => $request->event_prefecture,
            'event_venue' => $request->event_venue,
            'event_date' => $request->event_date,
            'event_starttime' => $request->event_starttime,
            'event_artist' => $request->event_artist,
            'event_imageUrl' => $request->event_imageUrl,
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
      //秒は表示させないよう切り取る
      $event->event_starttime = mb_substr($event->event_starttime,0,5);
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
        if (\Auth::id() === $event->user_id) {
            //秒は表示させないよう切り取る
            $event->event_starttime = mb_substr($event->event_starttime,0,5);
            return view('events.edit', [
                'event' => $event,
            ]);
        }else{
            return redirect('/');
        }   
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
           'event_imageUrl' => 'image',
        ]);
        if ($request->event_imageUrl !==NULL){
            $image = $request->file('event_imageUrl');
                    /**
             * 自動生成されたファイル名が付与されてS3に保存される。
             * 第三引数に'public'を付与しないと外部からアクセスできないので注意。
             */
            $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        
            /* ファイルパスから参照するURLを生成する */
            $request->event_imageUrl = Storage::disk('s3')->url($path);
        }        
        $event = Event::find($id);
        $event->event_name = $request->event_name;
        $event->event_prefecture = $request->event_prefecture;
        $event->event_venue = $request->event_venue;
        $event->event_date = $request->event_date;
        $event->event_starttime = $request->event_starttime;
        $event->event_artist = $request->event_artist;
        $event->event_remarks = $request->event_remarks;
        $event->event_imageUrl = $request->event_imageUrl;
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
