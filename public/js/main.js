$(document).ready(() => {
    const $deleteModal = $('#delete-modal');
    const $createModal = $('#create-modal');

    let handleRemoveItems = () => {
        $('.item-delete').each((key, item) => {
            $(item).on('click', e => {
                e.preventDefault();

                const target = e.target;
                const url = target.href;
                const id = target.dataset.id;

                $deleteModal.data({url, id}).modal('show');
            });
        });
    };

    let handleDeleteModal = () => {
        $deleteModal.find('.delete').on('click', () => {
            const url = $deleteModal.data('url');
            const id = $deleteModal.data('id');
            const itemRow = $('#item-row-' + id);

            $.ajax({
                method: "DELETE",
                url: url
            }).done(() => {
                $deleteModal.modal('hide');
                itemRow.remove();
            });
        });
    };

    let handleCreateModal = () => {
        $('#list-items .create').on('click', e => {
            $createModal.modal('show');

            // Fetch the form
            $.ajax({
                method: 'GET',
                url: e.target.dataset.url
            }).done(form => {
                $createModal.find('.modal-body').html(form);
                $createModal.find('.create').on('click', () => {
                    let form = $('#form-create-item');

                    // Submit form
                    $.ajax({
                        method: 'POST',
                        url: form.attr('action'),
                        data: form.serialize()
                    }).done((data) => {
                        window.location.reload();
                    })
                });
            });
        });
    };

    handleRemoveItems();
    handleDeleteModal();
    handleCreateModal();
});

