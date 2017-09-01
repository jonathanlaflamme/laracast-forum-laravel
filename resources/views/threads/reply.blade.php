<div class="panel panel-default">
    <div class="panel-heading">
        <a href="/user/{{ $reply->owner->id }}">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}
    </div>
    <div class="panel-body">
        {{ $reply->body }}
    </div>
</div>