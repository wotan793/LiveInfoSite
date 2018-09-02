<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventUserController extends Controller
{
    public function participate(Request $request, $id)
    {
        \Auth::user()->participate($request->id);
        return redirect()->back();
    }

    public function unparticipate($id)
    {
        \Auth::user()->unparticipate($id);
        return redirect()->back();
    }
    public function interested(Request $request, $id)
    {
        \Auth::user()->interested($id);
        return redirect()->back();
    }

    public function uninterested($id)
    {
        \Auth::user()->uninterested($id);
        return redirect()->back();
    }
}
