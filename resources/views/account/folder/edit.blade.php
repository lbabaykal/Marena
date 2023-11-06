<div class="window">
    <div class="window_container">
        <div class="window_heading">
            <div class="window_title">Редактирование папки</div>
            <div onclick="HideModalWindow()" class="window_close">❌</div>
        </div>
        <div class="window_content">
            <form id="edit_folder">
                <div class="label_input">
                    <div class="label">Название</div>
                    <div class="input"><input name="title" type="text" placeholder="Название..." value="{{ $folder->title }}" /></div>
                </div>
                <div class="label_input">
                    <div class="label">
                        Публичная?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="toggle-wrapper">
                            <input type="checkbox" name="isPublic" @checked( $folder->isPublic ) />
                            <div class="toggle-slider">
                                <div class="toggle-knob"></div>
                            </div>
                        </label>
                    </div>
                </div>
            </form>
            <div class="label_input">
                <div class="label">
                    <form action="{{ route('account.folders.destroy', $folder->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="margin: 0 auto">Удалить папку?</button>
                    </form>
                </div>
            </div>

        </div>
        <div class="buttons">
            <button type="button" onclick="editFolder()" class="button_edit">Изменить</button>
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

    function editFolder() {
        $.ajax({
            url: '{{ route('account.folders.update', $folder->id) }}',
            method: 'PATCH',
            dataType: 'json',
            data: jQuery("#edit_folder").serialize(),
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
            }
        });
    }
</script>
