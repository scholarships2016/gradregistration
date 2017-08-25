/**
 * Created by worakanpongnumkul on 7/10/2017 AD.
 */
var FormValidation = function () {

    var handlePersonalInfoValidation = function () {

        var form1 = $('#personalInfoForm');

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            rules: {
                name_title_id: {
                    required: true
                },
                stu_first_name: {
                    required: true
                },
                stu_last_name: {
                    required: true
                },
                stu_last_name: {
                    required: true
                },
                stu_first_name_en: {
                    required: true
                },
                stu_last_name_en: {
                    required: true
                },
                stu_sex: {
                    required: true
                },
                nation_id: {
                    required: true
                },
                stu_religion: {
                    required: true
                },
                stu_married: {
                    required: true
                },
                stu_birthdate: {
                    required: true
                },
                stu_email: {
                    required: true,
                    email: true
                },
                fund_interesting: {
                    required: true
                },
                'app_news_id[]': {
                    required: true,
                    minlength: 1,
                },
            },

            invalidHandler: function (event, validator) { //display error alert on form submit

            },

            errorPlacement: function (error, element) { // render error placement for each input type
                var cont = $(element).parent('.input-group');
                if (cont.size() > 0) {
                    cont.after(error);
                } else {
                    element.after(error);
                }
            },

            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error'); // set success class to the control group
            },
            submitHandler: function (form) {
            }
        });

    }

    return {
        init: function () {
            handlePersonalInfoValidation();
        }
    };
}();

$(document).ready(function () {
    FormValidation.init();
});