function deletePs (val) {
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

function searchRs(val) {
    console.log(val);

    $.ajax({
        url: "/pasien",
        dataType: 'JSON',
        type: 'GET',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            id: val,
        },
        success: function (data) {
            if (data.status == 'success') {
                console.log(data.data);
            }
        }
    });
}
