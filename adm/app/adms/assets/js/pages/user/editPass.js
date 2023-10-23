$(function() {
    $('.form-adm').validate({
        rules: {
            password: "required",
            co_password: {
                required: true,
                equalTo: "#password"
            }
        }
    })
});