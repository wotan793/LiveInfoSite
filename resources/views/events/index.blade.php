@extends('layouts.app')

@section('content')
<h1>イベント管理画面</h1>
@if ($events)
        <div class="event-manage">
            <table class="table table-bordered table-hover table-condensed">
                <thead>
                    <tr class="success">
                        <th>開催日</th>
                         <th>イベント名</th>
                         <th>アーティスト</th>
                         <th>開催地</th>
                         <th>会場</th>
                         <th>詳細</th>
                         <th>更新</th>
                         <th>削除</th>
                   </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->event_date }}</td>
                            <td>{{ $event->event_name }}</td>
                            <td>{{ $event->event_artist }}</td>
                            <td>{{ $event->event_prefecture }}</td>
                            <td>{{ $event->event_venue }}</td>
                            <td>
                                {!! link_to_route('events.show', '詳細', ['id' => $event->id], ['class' => 'btn btn-success']) !!}
                            </td>
                            <td>
                                {!! Form::model($event, ['route' => ['events.edit', $event->id], 'method' => 'get']) !!}
                                    {!! Form::submit('修正', ['class' => 'btn btn-success']) !!}
                                {!! Form::close() !!}
                            </td>
                            <td>
                                {!! Form::model($event, ['route' => ['events.destroy', $event->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endif


@endsection