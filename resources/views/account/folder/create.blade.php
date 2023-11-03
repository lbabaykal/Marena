<div class="window">
    <div class="window_container">
        <div class="window_heading">
            <div class="window_title">Создание папки</div>
            <div onclick="HideModalWindow()" class="window_close">❌</div>
        </div>
        <div class="window_content">

            <form id="create_folder">
                <div class="label_input">
                    <div class="label">Название</div>
                    <div class="input"><input name="title" type="text" placeholder="Название..."/></div>
                </div>
                <div class="label_input">
                    <div class="label">
                        Публичная?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="toggle-wrapper">
                            <input type="checkbox" name="isPublic" />
                            <div class="toggle-slider">
                                <div class="toggle-knob"></div>
                            </div>
                        </label>
                    </div>
                </div>
            </form>
        </div>
        <div class="buttons">
            <button type="button" onclick="createFolder()" class="button_save">Создать</button>
            <button type="button" onclick="HideModalWindow()" class="button_close">Отмена</button>
        </div>
    </div>
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function createFolder() {
        let Form = new FormData(document.getElementById('create_folder'));

        $.ajax({
            url: '{{ route('account.folders.store') }}',
            method: 'POST',
            dataType: 'json',
            data: Form,
            contentType: false,
            cache: false,
            processData: false,
            success (data) {
                new Notify ({
                    status: data.status,
                    title: 'Избранное',
                    text: data.text,
                    effect: 'fade',
                    speed: 300,
                    customClass: '',
                    customIcon: '',
                    showIcon: true,
                    showCloseButton: true,
                    autoclose: true,
                    autotimeout: 2500,
                    gap: 15,
                    distance: 15,
                    type: 2,
                    position: 'right bottom',
                    customWrapper: '',
                })
                HideModalWindow();
                setTimeout(() => {
                    location.reload();
                }, 2500);
            }
        });
    }
</script>
