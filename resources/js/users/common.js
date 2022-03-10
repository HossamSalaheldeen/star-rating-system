userSelectorQueryParams = {
    manager: {
        // 'except[0]':{},
        // 'except[1]':{}
    }
}

roleSelectorQueryParams = {
    role: {}
}

departmentSelectorQueryParams = {
    department: {}
}

enterpriseSelectorQueryParams = {
    enterprise: {}
}

branchSelectorQueryParams = {
    branch: {
        enterprise: ''
    }
}

activeSelectorQueryParams = {
    active: {}
}

$(function () {
    // userSelectorQueryParams['manager']['except[0]'] = 5;
    // userSelectorQueryParams['manager']['except[1]'] = 6;
    initUserSelector('#manager-selector', messages.selectors.users.manager, 'manager')
    initRoleSelector('#role-selector', messages.selectors.users.role, 'role')
    initDepartmentSelector('#department-selector', messages.selectors.users.department, 'department')
    initEnterpriseSelector('#enterprise-selector', messages.selectors.users.enterprise, 'enterprise')
    initBranchSelector('#branch-selector', messages.selectors.users.branch, 'branch')
    initActiveSelector('#active-selector', messages.selectors.active, 'status')
    $('#enterprise-selector').on("select2:unselect select2:clear", function (e) {
        delete branchSelectorQueryParams['branch']['enterprise'];
        $('#branch-selector').prop('disabled', true)
        $('#branch-selector').val('').trigger('change')
    })

    $('#enterprise-selector').on("select2:select", function (e) {
        branchSelectorQueryParams['branch']['enterprise'] = $(this).val()
        $('#branch-selector').prop('disabled', false)
    });

    $(document).on('change', '#is-viewer-checkbox', function () {
        if (this.checked) {
            console.log(this.value);
            if ($('.viewers_container').hasClass('d-none')) {
                $('.viewers_container').removeClass('d-none');
            }
        }else {
            $('.viewers_container').addClass('d-none');
        }
    });

    var attr = $('#users-selector').attr('readonly');
    if (typeof attr !== 'undefined' && attr !== false) {
        setTimeout(function () {
            console.log($('.multiselect-dropdown'))
            $('.multiselect-dropdown').attr('readonly', true);
        }, 40);
    }


})
