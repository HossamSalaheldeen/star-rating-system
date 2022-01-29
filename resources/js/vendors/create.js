$("#add-vendor-rating").validate({
    rules:{
        name: {
            required: true
        },
    },
    messages: {
        name: {
            required: 'This field is required'
        },
    },

    highlight: function (element, errorClass) {
        $(element).css('border','1px solid red');
    },
    unhighlight: function (element, errorClass) {
        $(element).css('.border','1px solid #ced4da');
    },

    errorElement : 'span',

    submitHandler: function(form) {
        if($('.star_label_1 .rating_star').hasClass('far'))
        {
            $('input[name="star"]').prop('checked', false);
        }
        form.submit();
    }
});
