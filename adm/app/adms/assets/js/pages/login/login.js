$(function() {
    $('.form-login').validate({
        rules: {
            user: "required",
            password: {
                required: true
            },
        }
    })
});