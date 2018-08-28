@extends('layouts.app')


@section('content')
    <div class="content">
        @include('events.events')
        {!! $events->render() !!}
    </div>
@endsection