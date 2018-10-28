<ul class="media-list">
@foreach ($messages as $message)
    <?php $user = $message->user; ?>
    <li class="media">
        <div class="media-left">
        <img class="media-object img-rounded center-block" src={{ $user->user_imageUrl}}  width="80" height="80">
        </div>
        <div class="media-body">
            <div>
                <span>{{$user->name}}</span>
                <span class="text-muted">posted at {{ $message->created_at }}</span>
            </div>
            <div>
                <p>{!! nl2br(e($message->content)) !!}</p>
                @if (Auth::id() == $message->user_id)
                    {!! Form::open(['route' => ['messages.destroy', $message->id], 'method' => 'delete']) !!}
                        {!! Form::submit('削除', ['class' => 'btn btn-danger btn-xs']) !!}
                    {!! Form::close() !!}
                @endif
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $messages->render() !!}