/**
 * Created by worakanpongnumkul on 5/24/2017 AD.
 */

var AddressSelect2 = function () {
    return {
        init: function (proId, distId, subdistId, zipId) {
            //init Province
            $(proId).select2({});

            //init District
            $(distId).select2({});

            //init SubDistrict
            $(subdistId).select2({});

            //init Zipcode
            $(zipId).select2({});
        },
        disableAll: function () {

        }
    };
}