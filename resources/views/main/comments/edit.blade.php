<div class="modal_window_content">
    <div class="window_heading">
        <div class="window_title">Изменение комментария</div>
        <div onclick="HideComment()" class="window_close">❌</div>
    </div>
    <div class="window_content">
        <form id="comment_edit" onsubmit="return false">
            @csrf
            <label for="comment">Комментарий:</label>
            <textarea id="comment" name="comment" rows="6" cols="10">{{$comment->comment}}</textarea>

            <div class="window_buttons">
                <button onclick="comment_edit({{$comment->id}})" type="submit" class="window_button button_save">Изменить</button>
                <button onclick="HideComment()" class="window_button button_close">Отмена</button>
            </div>
        </form>
    </div>
</div>

<style>
/*--------------ADMIN MODAL WINDOWS---------------*/
.modal_windows {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    opacity: 0;
    visibility: hidden;
    transform: scale(1.1);
    transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
}

.modal_window_content {
    width: 990px;
    display: flex;
    flex-direction: column;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: var(--white-color);
    box-shadow: 0 8px 16px 0 rgba(65,69,88,0.1),
    0 4px 8px 0 rgba(0,0,0,0.07);
}

.show-modal {
    opacity: 1;
    visibility: visible;
    transform: scale(1.0);
    transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
}

.window_heading {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%;
    background-color: #ddd;
    border-bottom: 1px solid var(--bg-color);
}

.window_title {
    padding: 10px 15px;
}

.window_close {
    margin: 10px 15px;
    cursor: pointer;
}

.window_buttons {
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    align-items: center;
}

.window_button {
    margin: 0 !important;
    cursor: pointer;
    min-width: 100px;
    line-height: 40px;
    text-align: center;
    background-color: #ddd;
    font-size: 16px;
    font-weight: 700;padding: 0 10px;
}

.button_save:hover {
    background-color: var(--green-color);
    color: var(--black-color);
}

.button_close:hover {
    background-color: var(--red-color);
    color: var(--white-color);
}

.window_content {
    padding: 10px 15px;
}

.window_content span {
    font-weight: 700;
}

.window_content form {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
}

.window_content form label {
    width: 300px;
    font-size: 20px;
    font-weight: 700;
    line-height: 1.5;
    margin: 5px 10px;
}

.window_content form input {
    width: 100%;
    font-size: 20px;
    line-height: 1.5;
    border-bottom: 1px solid var(--blue-color);
}
.window_content form select {
    width: 100%;
    font-size: 20px;
    line-height: 1.5;
    border-bottom: 1px solid var(--blue-color);
}

.genre_select {
    height: 140px;
}

.window_content form input:focus {
    border-bottom: 1px solid var(--red-color);
}

.window_content form textarea {
    width: 960px;
    min-height: 160px;
    border: solid 1px var(--black-color);
    resize: vertical;
    padding: 10px;
}
</style>
