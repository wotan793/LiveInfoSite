@extends('layouts.app')

@section('content')
    <div class="user-profile" id ="user">
        <div class="row">
            <div id="wrapper">
                <div class="col-xs-3 col-sm4 col-md-5 col-lg-4">
                    <div class="text-center">
                        <h1>{{'あなたの写真'}}</h1>
                    </div>
                    <div class="icon text-center">
                        @if ($user->user_imageUrl)
                            <img class="media-object img-rounded center-block" src={{ $user->user_imageUrl}}  width="200" height="200">
                            {!! Form::model($user, ['route' => ['user.photoDelete', $user->id], 'method' => 'put', 'files' => true]) !!}
                            {{Form::hidden('user_imageUrl', null)}}
                            {!! Form::submit('ピクチャを削除', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @else
                           <img class="media-object img-rounded img-responsive center-block" src={{ secure_asset("images/noimage.png") }}   width="200" height="200">
                        @endif
                    </div>
                </div>
                <div class="col-xs-3 col-sm4 col-md-5 col-lg-3" id="user-button">
                    <div class="form-group">
                    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put', 'files' => true]) !!}
                    {!! Form::label('user_imageUrl', 'ファイル選択') !!}
                    {!! Form::file('user_imageUrl', null) !!}
                    {!! Form::submit('アップロード', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection