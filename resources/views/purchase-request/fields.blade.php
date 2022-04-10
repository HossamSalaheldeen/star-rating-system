<div class="row">
    <div class="col-4 mb-4">
        <label for="name" class="form-label">{{__('purchase-request.items-name')}} <span
                class="text-danger">*</span></label>
        <div class="input-container">
            <input type="text" class="form-control" id="name" name="names[]"
                   placeholder="{{__('purchase-request.items-name')}}">
        </div>
    </div>

    <div class="col-4 mb-4">
        <label for="quantity" class="form-label">{{__('purchase-request.quantity')}} <span
                class="text-danger">*</span></label>
        <div class="input-container">
            <input type="number" class="form-control" name="quantities[]" min="0"
                   placeholder="{{__('purchase-request.quantity')}}"/>
        </div>
    </div>

    <div class="col-4 mb-4">
        <label for="price" class="form-label">{{__('purchase-request.price')}} <span
                class="text-danger">*</span></label>
        <div class="input-container">
            <input type="text" class="form-control" id="price" name="prices[]" disabled
                   placeholder="{{__('purchase-request.price')}}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4 mb-4">
        <label for="amount" class="form-label">{{__('purchase-request.amount')}} </label>
        <div class="input-container">
            <input type="text" class="form-control" id="amount" name="amounts[]" disabled
                   placeholder="{{__('purchase-request.amount')}}">
        </div>
    </div>
    <div class="col-4 mb-3">
        <label for="vendor" class="form-label">{{__('purchase-request.vendor')}} <span
                class="text-danger">*</span></label>
        <div class="input-container">
            <select id="category-selector" class="form-select" aria-label="Default select" name="vendor"
                    data-width="100%" data-placeholder="{{__('purchase-request.vendor')}}" disabled>
            </select>
        </div>
    </div>
    <div class="col-4 mb-4">
        <label for="rating" class="form-label">{{__('purchase-request.vendor-rating')}} </label>
        <div class="input-container">
            <div class="rating">
                <input type="radio" name="rating" value="5" id="5"> <label for="5">☆</label>
                <input type="radio" name="rating" value="4" id="4"> <label for="4">☆</label>
                <input type="radio" name="rating" value="3" id="3"> <label for="3">☆</label>
                <input type="radio" name="rating" value="2" id="2"> <label for="2">☆</label>
                <input type="radio" name="rating" value="1" id="1"> <label for="1">☆</label>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4 mb-4">
        <label for="name" class="form-label">{{__('purchase-request.note')}} </label>
        <div class="input-container">
            <textarea type="text" class="form-control" name="notes[]" rows="3"
                      placeholder="{{__('purchase-request.note')}}"></textarea>
        </div>
    </div>
</div>
