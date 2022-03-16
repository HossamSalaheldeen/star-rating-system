<div class="component cloneable-component" style="display: none">
    <div class="d-flex justify-content-between">
        <h1>POC <span class="poc-num"></span></h1>
        <button style="padding:0 7px;" class="btn delete-poc-btn" type="button" aria-expanded="false">
            <span style="color: red;" class="thinner_icon material-icons ">delete</span>
        </button>
    </div>
    <div class="row">
        <div class="col-6 mb-4">
            <label for="" class="form-label names_label">{{ __('vendors.properties.p_name') }} <span
                    class="text-danger">*</span></label>
            <div class="input-container">
                <input type="text" class="form-control names_input" id="" name=""
                       placeholder="{{ __('vendors.properties.p_name') }}">
            </div>
        </div>

        <div class="col-6 mb-4">
            <label for="" class="form-label emails_label">{{ __('vendors.properties.p_email') }} <span
                    class="text-danger">*</span></label>
            <div class="input-container">
                <input type="text" class="form-control emails_input" id="" name=""
                       placeholder="{{ __('vendors.properties.p_email') }}">
            </div>
        </div>

        <div class="col-6 mb-4">
            <label for="" class="form-label phones_label">{{ __('vendors.properties.p_phone') }} <span
                    class="text-danger">*</span></label>
            <div class="input-container">
                <input type="text" class="form-control phones_input" id="" name=""
                       placeholder="{{ __('vendors.properties.p_phone') }}"
                       oninput="this.value = this.value.replace(/[^0-9.+()\-]/g, '').replace(/(\..*)\./g, '$1');">
            </div>
        </div>
    </div>
</div>


