$(function () {
    // var clone = {};
    const ImagesInput = $('#imagesInput');
    const ImagesContainer = $('#slides-container');

    ImagesInput.dropify({
        messages: {
            'default': 'Select Your Files',
        }
    });

    const ImageSlide = (SRC) => {
        const ImageContainer = $('.image_slide:last').clone();
        const ImageElement = ImageContainer.find('.image_pic');
        ImageElement.attr('src', SRC);
        let fileElement = ImageContainer.find('.file_image');
        fileElement.remove();
        return ImageContainer;
    };

    const HandleFileInput = (Event) => {
        // console.log("fileElement",Event.target);
        // console.log("file",Event.target.value);
        // var fileElement = Event.target;
        // if (fileElement.value == "") {
        //     // var file = document.getElementById("file");
        //     document.body.appendChild(clone[fileElement.id]); //adding clone
        //     ImagesInput.parentNode.removeChild(ImagesInput); //removing parent
        // }

        let filesArr = Array.prototype.slice.call(Event.target.files);
        filesArr.forEach((File) => {
            if (File.type === "application/pdf") {
                const FileContainer = $('.image_slide:last').clone();
                let ImageElement = FileContainer.find('.image_pic');
                ImageElement.remove();
                ImagesContainer.append(FileContainer);
                FileContainer.fadeIn('slow');
            }
            if (File.type.match("image.*")) {
                const ImageView = new FileReader();
                ImageView.onload = (ImageEvent) => {
                    const ImageContainer = ImageSlide(ImageEvent.target.result);
                    ImagesContainer.append(ImageContainer);
                    ImageContainer.fadeIn('slow');
                };
                ImageView.readAsDataURL(File);
            }
        });
    };

    ImagesInput.on('change', HandleFileInput);

    // function clickFile(event) {
    //     console.log("click event is fired")
    //     var fileElement = event.target;
    //     if (fileElement.value != "") {
    //         clone[fileElement.id] = fileElement.cloneNode(true); //cpoying clone
    //     }
    //
    // }
    //
    // ImagesInput.on('click', clickFile);

    $(document).on('click', '.remove-img-btn', function () {
        $(this).parents('.image_slide').fadeOut('slow', function () {
            $(this).remove();
        });
        const Dropify = ImagesInput.dropify();
        const DropifyData = Dropify.data('dropify');
        DropifyData.resetPreview();
        DropifyData.clearElement();
    });
});
