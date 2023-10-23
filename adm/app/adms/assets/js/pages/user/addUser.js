$(function() {
    $('.form-adm').validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            user: "required",
            password: {
                required: true,
                minlength: 5
            },
            image: "required"
        }
    })
});