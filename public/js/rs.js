function deleteRs (val) {
    rs_id = val;
    $('#loading').css('display', 'block');

    $.ajax({
        url: "rumah-sakit/delete",
        dataType: 'JSON',
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: rs_id,
        },
        success: function (data) {
            if (data.status == 'success') {
                location.reload();
            }
        }
    });
}
