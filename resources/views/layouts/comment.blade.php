@if(!$articleComments->isEmpty())
    @foreach($articleComments as $comment)
        <div class="comments">
            <img class="user_comment_avatar" src="{{ asset('avatars/' . $comment->user->avatar) }}" alt="">
            <div class="user_comment_cont">
                <div class="user_info">
                    <div class="user_comment_name">{{ $comment->user->username }}</div>
                    <div class="user_group">{{ $comment->user->role->title }}</div>
                    <div class="comment_date">{{ $comment->date }}</div>
                    @if($comment->user->id == \Illuminate\Support\Facades\Auth::id())
                        <div class="delete_comment" style="cursor: pointer" onclick="ShowComment({{ $comment->id }})">🖍</div>
                    @endif
                </div>
                <div class="comment">{{ $comment->comment }}</div>
            </div>
        </div>
    @endforeach
@else
Комментариев нет
@endif


