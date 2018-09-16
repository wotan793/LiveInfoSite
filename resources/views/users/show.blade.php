@extends('layouts.app')

@section('content')
    <div class="user-profile">
        <div class="icon text-center">
            <img src="{{ Gravatar::src($user->email, 100) . '&d=mm' }}" alt="" class="img-circle">
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