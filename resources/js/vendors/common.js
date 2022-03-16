categorySelectorQueryParams = {
    category: {}
};

enterpriseSelectorQueryParams = {
    enterprise: {}
};

marketSelectorQueryParams = {
    market: {
        enterprise: ''
    }
};
// businessUnitSelectorQueryParams = {
//     businessUnit: {
//         enterprise: ''
//     }
// };


countrySelectorQueryParams = {
    country: {}
};

citySelectorQueryParams = {
    city: {
        country: ''
    }
};
let LoopIteration = 0;
$(function () {
    initCategorySelector('#category-selector', messages.selectors.vendors.category, 'category');
    initEnterpriseSelector('#enterprise-selector', messages.selectors.vendors.enterprise, 'enterprise');
    initMarketSelector('#market-selector', messages.selectors.vendors.market, 'market');
    // initBusinessUnitSelector('#business-unit-selector', messages.selectors.vendors.businessUnit, 'businessUnit');
    initCountrySelector('#country-selector', messages.selectors.vendors.country, 'country');
    initCitySelector('#city-selector', messages.selectors.vendors.city, 'city');

    $('#country-selector').on("select2:unselect select2:clear", function (e) {
        delete citySelectorQueryParams['city']['country'];
        $('#city-selector').attr('readonly',true);
        $('#city-selector').val('').trigger('change');
    });

    $('#country-selector').on("select2:select", function (e) {
        citySelectorQueryParams['city']['country'] = $(this).val();
        $('#city-selector').attr('readonly',false);
    });

    $('#enterprise-selector').on("select2:unselect select2:clear", function (e) {
        delete marketSelectorQueryParams['market']['enterprise'];
        $('#market-selector').attr('readonly', true);
        $('#market-selector').val('').trigger('change');
    });

    $('#enterprise-selector').on("select2:select", function (e) {
        marketSelectorQueryParams['market']['enterprise'] = $(this).val();
        $('#market-selector').attr('readonly', false);
    });

    $('#enterprise-selector').on("change", function (e) {
        $('#market-selector').val('').trigger('change');
    });

    $('#country-selector').on("change", function (e) {
        $('#city-selector').val('').trigger('change');
    });

    $(document).on("click", "#append-new-poc-btn", function () {
        appendNew();
    });

    $(document).on("click", ".delete-poc-btn", function () {
        // LoopIteration = $(this).parents('.component').find('.poc-num').attr('data-index');
        console.log($('.component').length);
        if ($('.component').length == 2) {
            toastr.error('You must have at least one POC');
        }else {
            $(this).parents('.component').fadeOut("slow",function () {
                $(this).remove()
            });
        }


    });
});
