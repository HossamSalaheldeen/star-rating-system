<form id="create-purchase-request-form" class="form_content mt-3" method="POST"
      action="{{Route::is("settings.leads.purchase-requests.create")
                ? route('settings.leads.purchase-requests.store',$lead->id)
                : route('settings.leads.sub-leads.purchase-requests.store',[$lead->id,$subLead->id])}}"
      enctype="multipart/form-data">
    @csrf
    <div class="container-fluid p-5 rounded create-purchase-request-item-form">
        <p>{{__('purchase-request.instructions')}}</p>
        <div id="single-item">
            @include('settings.purchase-requests.fields')
        </div>
{{--        <input type="text" name="lead_type" class="d-none" value="{{$type}}">--}}
{{--        <input type="text" name="lead_id" class="d-none" value="{{$id}}">--}}
        <button type="submit" class="btn purchase-request-add-item-btn float-end" id="add-item-btn">{{ __('purchase-request.add-item-btn') }}</button>
    </div>
    <br>
    <div id="purchase-request-new-item"></div>
    <br>

    @include('settings.purchase-requests.attachments-upload')

</form>
