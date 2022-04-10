@forelse($purchaseRequest->attachments as $attachment)
    <div class="image_slide">
        <div class="image_box">
            @if($attachment->attachment_extension === 'jpg' | $attachment->attachment_extension === 'jpeg' | $attachment->attachment_extension === 'png')
                <img class="image_pic" src="{{ asset($attachment->attachment_url)}}" alt="image icon">
                <input type="hidden" name="files[]" value="{{$attachment->id}}">
            @else
                <img class="file_image" src="{{asset('images/pdf.png')}}" alt="pdf icon">
                <input type="hidden" name="files[]" value="{{$attachment->id}}">
            @endif
            <button type="button" class="btn p-0 remove-img-btn"><span class="thinner_icon text-danger material-icons">delete</span>
            </button>
        </div>
    </div>
@empty

@endforelse
