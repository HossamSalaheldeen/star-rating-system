let maxPasswordLength = 100
let minCodeLength = 2;
let maxCodeLength = 10;
let isEdit = false;

function initUserValidation(formSelector, submitHandler) {
    return $(formSelector).validate({
        rules: {
            name: {
                required: true,
                characters : true,
                minlength:minStringLength,
                maxlength:maxStringLength,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            code: {
                required: true,
                minlength: minCodeLength,
                maxlength: maxCodeLength,
                CharacterAndNumbersWithoutSpace: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            email: {
                required: true,
                email: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            role_id: {
                required: true,
            },
            password: {
                required: !isEdit,
                maxlength: maxPasswordLength,
                complexPassword: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            password_confirmation: {
                required: !isEdit,
                equalTo: "#password",
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            department_id: {
                required: true,
            },
            manager_id: {
            },
            initial_job_code: {
                number:true,
                min:0,
                normalizer: function (value) {
                    return $.trim(value);
                },
            },
            enterprise_id: {
                required: true,
            },
            branch_id: {
                required: true,
            },
        },

        ...validationProperties,

        submitHandler: function (form) {
            submitHandler()
        },
    })
}
