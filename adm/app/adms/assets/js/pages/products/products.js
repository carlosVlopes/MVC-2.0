$(function() {

	$('.form-adm').validate({
        rules: {
            name: "required",
            description: "required",
            price: "required",
            orderby: "required",
            image: "required"
        }
    })

    $('.form-adm-edit').validate({
        rules: {
            name: "required",
            description: "required",
            price: "required",
            orderby: "required"
        }
    })

});
