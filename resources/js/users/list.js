$(function (){
    $('.delete-user-btn').on('click',function (){
        showConfirmDeleteModal($(this).attr('data-id'),$(this).attr('data-url'))
    })
})

