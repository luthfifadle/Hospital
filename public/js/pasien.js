function deleteRs (val) {
    ps_id = val;

    $.ajax({
        url: "pasien/delete",
        dataType: 'JSON',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: ps_id,
        },
        success: function (data) {
            if (data.status == 'success') {
                location.reload();
            }
        }
    });
}
