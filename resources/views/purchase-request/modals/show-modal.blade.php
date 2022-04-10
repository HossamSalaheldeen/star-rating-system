<div class="modal fade show_modal" id="show-modal" data-bs-backdrop="static" tabindex="-1"
     aria-labelledby="showEnterprise"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('purchase-request.details') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Items Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Vendor</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Vendor Rating</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchaseRequestItems as $index => $purchaseRequestItem)
                        <tr>
                            <th scope="row">{{$index + 1}}</th>
                            <td>{{$purchaseRequestItem->name}}</td>
                            <td>{{$purchaseRequestItem->quantity}}</td>
                            <td>{{$purchaseRequestItem->price}}</td>
                            <td>{{$purchaseRequestItem->vendor}}</td>
                            <td>{{$purchaseRequestItem->amount}}</td>
                            <td>{{$purchaseRequestItem->vendor_rate}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="w-100 p-3" style="background-color: rgba(14,34,61,0.31)">
                <h6 class="text-white">{{__('purchase-request.payment-info')}}</h6>
            </div>
            <div class="row p-4">
                <div class="col-3">
                    <h6 class="bold">{{__('purchase-request.item-total')}}</h6>
                    <p>{{$purchaseRequest->total_amount}}</p>
                </div>
                <div class="col-3">
                    <h6 class="bold">{{__('purchase-request.total-vat')}}</h6>
                    <p>{{$purchaseRequest->total_vat_amount}}</p>
                </div>
                <div class="col-3">
                    <h6 class="bold">{{__('purchase-request.total-without-vat')}}</h6>
{{--                    total without vat--}}
{{--                    <p>{{$purchaseRequest->}}</p>--}}
                </div>
                <div class="col-3">
                    <h6 class="bold">{{__('purchase-request.total')}}</h6>
{{--                    total--}}
{{--                    <p>{{$purchaseRequest->}}</p>--}}
                </div>
            </div>
        </div>
    </div>
</div>
