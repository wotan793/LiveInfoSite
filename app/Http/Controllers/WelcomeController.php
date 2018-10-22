<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;


class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('event_date', '>=', date('Y/m/d'))->orderBy('event_date', 'asc')->paginate(10);
        return view('welcome', [
            'events' => $events,
        ]);
    }
}