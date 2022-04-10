let maxNameLength = 100;
let minLength = 2;

function initPurchaseRequestValidation(formSelector, submitHandler) {
    return $(formSelector).validate({
        rules: {
            'names[]': {
                required: true,
                minlength: minLength,
                maxlength: maxNameLength,
                CharacterAndNumbers: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            'quantities[]': {
                required: true,
                minlength: 1,
                min:1,
                number: true
            },
        },

        ...validationProperties,

        submitHandler: function (form) {
            submitHandler();
        },
    });
}
