$(function() {
    $('#data_1 .input-group.date').datepicker({
        format: 'dd/mm/yyyy',
    });

    $('.form-adm').validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            user: "required"
        }
    })
});