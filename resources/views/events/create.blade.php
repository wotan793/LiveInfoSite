@extends('layouts.app')

@section('content')
<div id="event">
    <h1>イベント追加画面</h1>
    <div class="row">
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
            {!! Form::model($event,['route' => 'events.store', 'class' => 'form', 'files' => true]) !!}
                <div class="form-group"> 
                    {!! Form::label('event_name', 'イベント名:')!!}
                    {!! Form::text('event_name', null, ['class' => 'form-control', "placeholder"=>"(例)サンプルツアー 2018"])!!}
                </div>

                <div class="form-group"> 
                    {!! Form::label('event_prefecture', '開催地:')!!}
                    {!! Form::text('event_prefecture', null, ['class' => 'form-control', "placeholder"=>"(例)東京"])!!}
                </div>

                <div class="form-group"> 
                    {!! Form::label('event_venue', '会場:')!!}
                    {!! Form::text('event_venue', null, ['class' => 'form-control',"placeholder"=>"(例)CLUB サンプル"])!!}
                </div>

                <div class="form-group"> 
                    {!! Form::label('event_date', '開催日:')!!}
                    {!! Form::text('event_date', null, ['class' => 'form-control',"placeholder"=>"(例)2018-09-15"])!!}
                </div>

                <div class="form-group">  
                    {!! Form::label('event_starttime', 'スタート時間:')!!}
                    {!! Form::text('event_starttime', null, ['class' => 'form-control',"placeholder"=>"(例)19:00"])!!}
                </div>

                <div class="form-group"> 
                    {!! Form::label('event_artist', '出演者:')!!}
                    {!! Form::text('event_artist', null, ['class' => 'form-control',"placeholder"=>"(例)バンドA,バンドB"])!!}
                </div>

                <div class="form-group"> 
                    {!! Form::label('event_remarks', '備考:')!!}
                    {!! Form::text('event_remarks', null, ['class' => 'form-control',"placeholder"=>"(例)バンドA,バンドBによるサンプルツアーの開催が決定!!"])!!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('event_imageUrl', 'フライヤー画像のアップロード') !!}
                    {!! Form::file('event_imageUrl', null) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('この内容で登録する', ['class' => 'btn btn-primary']) !!}
                </div>
        
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection