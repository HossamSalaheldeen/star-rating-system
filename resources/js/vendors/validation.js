let maxLength = 100;
let maxHostLength = 50;
let maxPhoneLength = 20;
let minPhoneLength = 9;
let minLength = 2;
let isEdit = false;

function initVendorValidation(formSelector, submitHandler) {
    return $(formSelector).validate({
        rules: {
            name: {
                required: true,
                minlength: minLength,
                maxlength: maxLength,
                CharacterAndNumbers: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            vat_number: {
                required: true,
                maxlength: maxLength,
                CharacterAndNumbers: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            address: {
                required: true,
                maxlength: maxLength,
                CharacterAndNumbers: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            country_id: {
                required: true,
                numbers: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            city_id: {
                required: true,
                numbers: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },

            enterprise_id: {
                required: true,
                numbers: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },

            business_unit_id: {
                required: true,
                numbers: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            email: {
                required: true,
                email:true,
                maxlength: maxHostLength,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            category_id: {
                required: true,
                numbers: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            market_id: {
                required: true,
                numbers: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            'names[1]': {
                required: true,
                maxlength: maxLength,
                CharacterAndNumbers: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            'emails[1]': {
                required: true,
                email:true,
                maxlength: maxHostLength,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            'phones[1]': {
                required: true,
                maxlength: maxPhoneLength,
                minlength: minPhoneLength,
                validPhone: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
        },

        ...validationProperties,

        submitHandler: function (form) {
            submitHandler();
        },
    });
}
