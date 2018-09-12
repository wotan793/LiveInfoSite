@if (Auth::user()->is_participating($event->id))
    {!! Form::open(['route' => ['event.unparticipate', $event->id], 'method' => 'delete']) !!}
        {!! Form::submit('参加', ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['event.participate', $event->id]]) !!}
        {!! Form::submit('参加', ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}
@endif


@if (Auth::user()->is_interesting($event->id))
    {!! Form::open(['route' => ['event.uninterested', $event->id], 'method' => 'delete']) !!}
        {!! Form::submit('興味あり', ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['event.interested', $event->id]]) !!}
        {!! Form::submit('興味あり', ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}
@endif



