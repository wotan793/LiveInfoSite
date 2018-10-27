@extends('layouts.app')

@section('content')
    <div class="user-profile">
        <div class="icon text-center">
            @if ($user->user_imageUrl)
                <img class="media-object img-rounded center-block" src={{ $user->user_imageUrl}} width="200" height="200" alt="" class="img-circle">
            @else
               <img class="media-object img-rounded img-responsive center-block" src={{ secure_asset("images/noimage.png") }}   width="200" height="200">
            @endif
        </div>
        <div class="name text-center">
            <h1>{{ $user->name }}</h1>
        </div>
        <div class="status text-center">
            <ul>
                <li>
                    <div class="status-label">参加</div>
                    <div id="count_participate" class="status-value">
                        {{ $count_participate }}
                    </div>
                </li>
                <li>
                    <div class="status-label">興味あり</div>
                    <div id="count_interested" class="status-value">
                        {{ $count_interested }}
                    </div>
                </li>
            </ul>
        </div>
    </div>
    @include('events.myevents', ['events' => $events])
    {!! $events->render() !!}
@endsection