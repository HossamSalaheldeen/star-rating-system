$(function () {
    let items = 0, itemsTotal = 0;

    $('input[name^="quantities"]').change(function () {
        itemsTotal = $('input[name^="quantities"]').val();
        $("#items-total").html(itemsTotal);
    });

    $('#add-item-btn').click((e) => {
        e.preventDefault();
        $('input[name^="quantities"]').off('change');
        items += 1;
        let singleItem = $('#single-item').clone();
        singleItem[0].id = 'single-item' + items;
        singleItem[0].className = 'container-fluid p-5 rounded create-purchase-request-item-form';
        singleItem.find('input, textarea').val('');
        $('#purchase-request-new-item').append('<br/>');
        $('#purchase-request-new-item').append(singleItem);
        $('#single-item' + items).prepend(`<h2 class="item-header">Item ${items}<h2/>`);
        $('#single-item' + items).prepend(`<button type="button" class="btn float-end remove-item-btn-${items}"><span class="thinner_icon material-icons">delete</span></button>`);

        $('input[name^="quantities"]').each(function () {
            $(this).on('focusin', function () {
                $(this).data('val', $(this).val());
            });

            $(this).on('change', function () {
                let prevValue = +$(this).data('val');
                let currentValue = +$(this).val();
                if (prevValue !== currentValue) {
                    itemsTotal -= prevValue;
                    itemsTotal += currentValue;
                    $("#items-total").html(itemsTotal)
                }
            });
        });

        $(`.remove-item-btn-${items}`).click((e) => {
            e.preventDefault();
            items -= 1;
            e.currentTarget.parentNode.previousSibling.remove();
            e.currentTarget.parentNode.remove();
        });
    });




    // $('.input-images').imageUploader({
    //     label: 'Upload Invoice Here or Drag & Drop File'
    // });
//     $.fn.filepond.registerPlugin(FilePondPluginImagePreview);
//
//     // Turn input element into a pond
//     $('.my-pond').filepond();
//
// // Turn input element into a pond with configuration options
//     $('.my-pond').filepond({
//         allowMultiple: true,
//     });
//
// // Set allowMultiple property to true
//     $('.my-pond').filepond('allowMultiple', false);
//
// // Listen for addfile event
//     $('.my-pond').on('FilePond:addfile', function (e) {
//         console.log('file added event', e);
//     });
//
// // Manually add a file using the addfile method
//     $('.my-pond')
//         .filepond('addFile', 'index.html')
//         .then(function (file) {
//             console.log('file added', file);
//         });
});
