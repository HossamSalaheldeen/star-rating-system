

function appendNew() {
    const newComp = $(".cloneable-component:first").clone();

    let lastCompIteration = 0;
    let lastCompId = 0;

    lastCompIteration = $(".poc-many-forms-container .poc-num:last").attr("data-index");
    lastCompId = $(".poc-many-forms-container .row:last").attr("data-id");

    lastCompIteration = parseInt(lastCompIteration) + 1;
    lastCompId = parseInt(lastCompId) + 1;

    newComp.find(".poc-num").attr("data-index", lastCompIteration);
    newComp.find(".poc-num").text(lastCompIteration);

    newComp.find(".row").attr("data-id", lastCompId);

    newComp.find(".names_label").attr("for", `names_${lastCompId}`);
    newComp.find(".emails_label").attr("for", `emails_${lastCompId}`);
    newComp.find(".phones_label").attr("for", `phones_${lastCompId}`);

    newComp.find(".names_input").attr("id", `names_${lastCompId}`);
    newComp.find(".emails_input").attr("id", `emails_${lastCompId}`);
    newComp.find(".phones_input").attr("id", `phones_${lastCompId}`);

    newComp.find(".names_input").attr("name", `names[${lastCompId}]`);
    newComp.find(".emails_input").attr("name", `emails[${lastCompId}]`);
    newComp.find(".phones_input").attr("name", `phones[${lastCompId}]`);

    $('.poc-many-forms-container').append(newComp);
    newComp.removeClass('cloneable-component');
    newComp.fadeIn("slow");

    $(`input[name="names[${lastCompId}]"]`).rules("add", {
        required: true,
        maxlength: 100,
        CharacterAndNumbers: true,
        normalizer: function (value) {
            return $.trim(value);
        },
    });

    $(`input[name="emails[${lastCompId}]"]`).rules("add", {
        required: true,
        email: true,
        maxlength: 50,
        normalizer: function (value) {
            return $.trim(value);
        },
    });

    $(`input[name="phones[${lastCompId}]"]`).rules("add", {
        required: true,
        maxlength: 20,
        minlength: 9,
        validPhone: true,
        normalizer: function (value) {
            return $.trim(value);
        },
    });

}
