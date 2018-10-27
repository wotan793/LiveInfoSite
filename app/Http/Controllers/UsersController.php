<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use \App\User;
use \App\Event;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(\Auth::id());
        return view('users.edit', [
            'user' => $user,
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $user = User::find($id);
        
        $count_participate = $user->participate_events()->count();
        $count_interested = $user->interested_events()->count();
        $events = $user->events_user()->orderBy('event_date', 'asc')->paginate(12);

        return view('users.show', [
            'user' => $user,
            'count_participate' => $count_participate,
            'count_interested' => $count_interested,
            'events' => $events,
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
        //
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
           'user_imageUrl' => 'required|image',
        ]);
        if ($request->user_imageUrl !==NULL){
            $image = $request->file('user_imageUrl');
                    /**
             * 自動生成されたファイル名が付与されてS3に保存される。
             * 第三引数に'public'を付与しないと外部からアクセスできないので注意。
             */
            $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        
            /* ファイルパスから参照するURLを生成する */
            $request->user_imageUrl = Storage::disk('s3')->url($path);
        }        
        $user = User::find($id);
        $user->user_imageUrl = $request->user_imageUrl;
        $user->save();

        return redirect()->back();
    }


    /**
     * photoDelete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function photoDelete(Request $request, $id)
    {
        $user = User::find($id);
        $user->user_imageUrl = null;
        $user->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
