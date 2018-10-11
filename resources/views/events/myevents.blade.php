@if ($events)
    <div class="row">
        @foreach ($events as $key => $event)
            <div class="myevent">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            @if ($event->event_imageUrl)
                                <img src="{{ $event->event_imageUrl }}" width="230" height="300">
                            @else
                                <img src="{{ secure_asset("images/noimage.png") }}"  width="240" height="300">
                            @endif
                        </div>
                        <div class="panel-body" id ="panel-myevent">
                            @if ($event->id)
                            <p>
                                <span class="glyphicon glyphicon-time"></span>
                                {{ $event->event_date}}
                            </p>
                            <p>
                                <span class="glyphicon glyphicon-map-marker"></span>
                                {{ $event->event_venue}}&nbsp;{{ $event->event_prefecture}}
                            </p>
                                <p class="event-title"><a href="{{ route('events.show', $event->id) }}">{{ $event->event_name }}</a></p>
                            @else
                                <p class="event-title">{{ $event->event_name }}</p>
                            @endif
                            <div class="buttons text-center">
                                @if (Auth::check())
                                    @include('event_user.event_interested_button', ['event' => $event])
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif