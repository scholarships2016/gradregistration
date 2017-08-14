/**
 * Created by worakanpongnumkul on 6/25/2017 AD.
 */
var FormRepeater = function () {

    return {
        //main function to initiate the module
        init: function () {
            $('.mt-repeater').each(function (index) {
                $(this).repeater({
                    show: function () {
                        console.log(this);
                        $(this).slideDown();
                        $(".select2").select2({
                            allowClear: true,
                            width: null,
                            placeholder: '--Select--'
                        });


                        console.log($(this).find("#edu_year"));

                    },

                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);

                    },

                    ready: function (setIndexes) {

                    }

                });
            });
        }

    };

}();

$(document).ready(function () {
    FormRepeater.init();
});
