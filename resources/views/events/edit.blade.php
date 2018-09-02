@extends('layouts.app')

@section('content')

    <h1>イベント編集ページ</h1>
    
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">

        {!! Form::model($event, ['route' => ['events.update', $event->id], 'method' => 'put']) !!}
                <div class="form-group"> 
                    {!! Form::label('event_name', 'イベント名:')!!}
                    {!! Form::text('event_name', null, ['class' => 'form-control'])!!}
                </div>

                <div class="form-group"> 
                    {!! Form::label('event_prefecture', '開催地:')!!}
                    {!! Form::text('event_prefecture', null, ['class' => 'form-control'])!!}
                </div>

                <div class="form-group"> 
                    {!! Form::label('event_venue', '会場:')!!}
                    {!! Form::text('event_venue', null, ['class' => 'form-control'])!!}
                </div>

                <div class="form-group"> 
                    {!! Form::label('event_date', '開催日:')!!}
                    {!! Form::text('event_date', null, ['class' => 'form-control'])!!}
                </div>

                <div class="form-group"> 
                    {!! Form::label('event_starttime', 'スタート時間:')!!}
                    {!! Form::text('event_starttime', null, ['class' => 'form-control'])!!}
                </div>

                <div class="form-group"> 
                    {!! Form::label('event_artist', '出演者:')!!}
                    {!! Form::text('event_artist', null, ['class' => 'form-control'])!!}
                </div>

                <div class="form-group"> 
                    {!! Form::label('event_remarks', '備考:')!!}
                    {!! Form::text('event_remarks', null, ['class' => 'form-control'])!!}
                </div>

            {!! Form::submit('更新', ['class' => 'btn btn-default']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection