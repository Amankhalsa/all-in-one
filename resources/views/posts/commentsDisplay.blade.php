@foreach($comments as $comment)
    <div class="display-comment" @if($comment->parent_id != null) style="margin-left:30px; background-color:lightgray;" @endif>
        <strong>{{ $comment->user->name }}</strong>
        <p>{{ $comment->body }}</p>
        <a href="" id="reply"></a>
        <form method="post" action="{{ route('store_comments',$post_id) }}">
            @csrf
            <div class="form-group">
                <input type="text" name="body" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
        </form>
  
        @include('posts.commentsDisplay', ['comments' => $comment->replies])
    </div>
@endforeach