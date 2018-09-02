@extends('layouts.app')

@section('content')
    <div class="user-profile">
        <div class="name text-center">
            <h1>{{ $user->name }}</h1>
        </div>
    </div>
@endsection