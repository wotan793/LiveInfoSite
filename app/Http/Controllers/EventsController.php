<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Event;

  class EventsController extends Controller
  {
    public function show($id)
    {
      $event = Event::find($id);

      return view('events.show', [
          'event' => $event,
      ]);
    }
  }