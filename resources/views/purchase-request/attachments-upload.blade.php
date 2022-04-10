<div class="d-flex justify-content-center">
    <input type="file" class="images_input payload dropify" id="imagesInput" name="attachments[]"
           data-allowed-file-extensions="pdf png jpg jpeg"
           data-height="300" multiple/>
</div>


<div class="mt-3 d-flex gap-3 flex-wrap" id="slides-container">
    @include('settings.purchase-requests.attachments-list')
</div>

<div class="image_slide" style="display: none">
    <div class="image_box">
        <img class="image_pic" src="" alt="image icon">
        <img class="file_image" src="{{asset('images/pdf.png')}}" alt="pdf icon">
        <button type="button" class="btn p-0 remove-img-btn"><span class="thinner_icon text-danger material-icons">delete</span></button>
    </div>
</div>
