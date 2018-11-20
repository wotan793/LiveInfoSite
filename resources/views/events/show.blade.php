@extends('layouts.app')

@section('content')
    <div class="row">
        <div id="wrapper">
            <div class="col-xs-3 col-sm4 col-md-5 col-lg-6">
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
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>{{ $event->event_name."について"}}</p>
                        <p class="event-remarks">{{ $event->event_remarks }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-sm-4 col-md-5 col-lg-6">
                <div class="event-detail">
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
                                <p>
                                    @if ($event->event_imageUrl)
                                        <img class="media-object img-rounded img-responsive" src={{ $event->event_imageUrl}}  width="300" height="300">
                                    @else
                                        <img class="media-object img-rounded img-responsive" src={{ secure_asset("images/noimage.png") }}  width="300" height="300">
                                    @endif
                                </p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content_message')
    <div class="row">
        <div id="message">
            <div class="col-xs-6 col-sm-7 col-md-10 col-lg-12">
                <ul class="nav nav-tabs nav-justified">
                    <div class="form-group">
                        <h4>{{ "コメントボックス"}}</h4>
                        @if (Auth::check())
                        {!! Form::open(['route' => 'messages.store']) !!}
                            <div class="form-group">
                                {{Form::hidden('event_id', $event->id)}}
                                {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                                {!! Form::submit('コメント', ['class' => 'btn btn-primary btn-block']) !!}
                            </div>
                        {!! Form::close() !!}
                        @endif
                        @if (count($messages) > 0)
                            @include('messages.messages', ['messages' => $messages])
                        @endif

                    </div>
                </ul>
            </div>
        </div>
    </div>
@endsection


