isEdit = true;
$(function () {
    branchSelectorQueryParams['branch']['enterprise'] = $('#enterprise-selector').val()
    initUserValidation('#edit-user-form',()=>{
      save('#edit-user-form');
    });

});

