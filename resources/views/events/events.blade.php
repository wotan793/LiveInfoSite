@if ($events)
        <div class="event">
            <table class="table table-bordered table-hover table-condensed">
                <thead>
                    <tr class="success">
                        <th>開催日</th>
                         <th>イベント名</th>
                         <th>アーティスト</th>
                         <th>開催地</th>
                         <th>会場</th>
                         <th>詳細</th>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endif
