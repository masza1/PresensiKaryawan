$('#getPayroll').on('click', function () {
    var periode = $('#setPeriode').val();
    if (periode == null || periode == "") {
        alert('pilih periode dulu')
    } else {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/payroll/" + periode,
            type: 'POST',
            data: { periode: periode },
            success: function (data) {
                $('#tableBody').empty();
                $('#tableBody').empty().append(data);
            },
            error: function (exception) { alert('Exeption:' + exception); }
        });
    }
});

$('#approved').on('click', function () {
    var id = $(this).attr('data-payrollId')
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/payroll/" + id,
        type: 'PATCH',
        data: { id: id },
        success: function (data) {
            $('#tableBody').empty();
            $('#tableBody').empty().append(data);
        },
        error: function (exception) { alert('Exeption:' + exception); }
    });
});