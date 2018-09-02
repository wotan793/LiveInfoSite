@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12 col-md-offset-3">
            <div class="wrapper">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p class="event-name">{{ $event->event_name }}</p>
                        <p>{{ $event->event_date."@".$event->event_venue}}</p>
                        <div class="buttons text-center">
                        @if (Auth::check())
                            @include('event_user.event_interested_button',['event' => $event])
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="want-users">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="buttons text-left">
                            <p>
                                <span class="glyphicon glyphicon-time"></span>
                                {{ $event->event_date}}&nbsp;{{ $event->event_starttime}}
                            </p>
                            <p>
                                <span class="glyphicon glyphicon-map-marker"></span>
                                {{ $event->event_venue}}&nbsp;{{ $event->event_prefecture}}
                            </p>
                            <p>
                                <span class="glyphicon glyphicon-user"></span>
                                {{ $event->event_artist}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('aside')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12 col-md-offset-3">
            <div class="aside">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>概要</p>
                        <p class="event-remarks">{{ $event->event_remarks }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
