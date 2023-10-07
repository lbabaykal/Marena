const Notification = document.querySelector('#notification');
const Warning = document.querySelector('#warning_rating');
const WarningText = document.querySelector('#warning_rating span');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function rating(article_id, assessment) {
    $.ajax({
        url: '/rating_assessments',
        method: 'POST',
        dataType: 'json',
        data: { article_id: article_id,
                assessment: assessment },
        success (data) {
            if (data.success === "Yes") {
                Warning.classList.remove('warning__RED');
                Warning.classList.add('warning__GREEN');
                WarningText.innerText = 'Оценка добавлена.';
                setTimeout(() => {
                    Warning.classList.remove('warning__GREEN'); }, 2000);
            }
            if (data.success === "Yess") {
                Warning.classList.remove('warning__RED');
                Warning.classList.add('warning__GREEN');
                WarningText.innerText = 'Оценка изменена на ' + assessment;
                setTimeout(() => {
                    Warning.classList.remove('warning__GREEN'); }, 2000);
            }
            if (data.success === "No") {
                Warning.classList.add('warning__RED');
                WarningText.innerText = 'Необходимо авторизоваться!';
                setTimeout(() => {
                    Warning.classList.remove('warning__RED'); }, 2000);
            }
        }
    });
}

function favorite(article_id) {
    const Favourite = document.querySelector('#favourite');

    $.ajax({
        url: '/favorites',
        method: 'POST',
        dataType: 'json',
        data: { article_id: article_id },
        success (data) {
            if (data.success === "Yess") {
                Favourite.classList.remove('favourite_active');
                Notification.classList.add('notification');
                Notification.innerText = 'Убрано из избранного!';
                setTimeout(() => {
                    Notification.classList.remove('notification');
                }, 4000);
            }
            if (data.success === "Yes") {
                Favourite.classList.add('favourite_active');
                Notification.classList.add('notification');
                Notification.innerText = 'Добавлено в избранное!';
                setTimeout(() => {
                    Notification.classList.remove('notification');
                }, 2000);
            }
            if (data.success === "No") {
                Notification.classList.add('notification');
                Notification.innerText = 'Необходимо авторизоваться!';
                setTimeout(() => {
                    Notification.classList.remove('notification');
                }, 2000);
            }
        }
    });
}

function comment_add(article_id) {
    let Form = document.getElementById('add_comment');
    let FormReady = new FormData(Form);
    FormReady.append('article_id', article_id);

    $.ajax({
        url: '/comments',
        method: 'POST',
        dataType: 'json',
        data: FormReady,
        processData: false,
        contentType: false,
        cache: false,
        success (data) {
            if (data.success === "Yes") {
                Notification.classList.add('notification');
                Notification.innerText = 'Комментарий успешно добавлен.';
                setTimeout(() => {
                    Notification.classList.remove('notification');
                    location.reload();
                }, 1000);
            }
            if (data.success === "No") {
                Notification.classList.add('notification');
                Notification.innerText = 'Необходимо авторизоваться!';
                setTimeout(() => {
                    Notification.classList.remove('notification');
                }, 2000);
            }
        }
    });
}

const Modal_Comment = document.querySelector('.modal_comment');

function HideComment() {
    Modal_Comment.classList.toggle("show-modal");
}

function ShowComment(id_comment) {
    $(".modal_comment").load("/comments/" + id_comment + "/edit");
    Modal_Comment.classList.toggle("show-modal");
}

function comment_edit(comment_id) {

    let display = $('textarea#comment').text();
    alert(display);
    $.ajax({
        url: '/comments/' + comment_id,
        method: 'PATCH',
        dataType: 'json',
        data: { comment: display },
        success (data) {
            if (data.success === "Yes") {
                Notification.classList.add('notification');
                Notification.innerText = 'Комментарий изменён!';
                setTimeout(() => {
                    Notification.classList.remove('notification');
                    location.reload();
                }, 1000);
            }
            if (data.success === "No") {
                Notification.classList.add('notification');
                Notification.innerText = 'Необходимо авторизоваться!';
                setTimeout(() => {
                    Notification.classList.remove('notification');
                }, 2000);
            }
        }
    });
}
