/**
 * 
 * @include[jquery.validate.min.js]
 */
$(function () {
    $.validator.setDefaults({
        errorClass: "help-block",
        onfocusout: false,
        highlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorPlacement: function (error, element) {
            if (element.prop('type') === 'checkbox' && error.text() !== "") {
                error.appendTo(element.closest(".checkbox"));
            } else if (element.prop('type') === 'radio' && error.text() !== "") {
                error.appendTo(element.closest(".radio"));
            } else if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                if (error.text() !== "") {
                    error.insertAfter(element);
                }
            }
        },
        invalidHandler: function(form, validator) {
            validator.focusInvalid();
        }
    });
});
