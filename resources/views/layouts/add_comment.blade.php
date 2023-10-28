<div class="add_comment_cont">
    <div class="add_comment_title">ДОБАВИТЬ КОММЕНТАРИЙ</div>
    <div class="add_comment">
        <form id="add_comment" onsubmit="return false" autocomplete="off">
            <textarea id="comment" rows="1" cols="1" name="comment"></textarea>
            <button onclick="comment_add({{ $article->id }})">ОТПРАВИТЬ</button>
        </form>
    </div>
</div>
