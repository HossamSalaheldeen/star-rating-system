{{-- @dd($vendor) --}}
<div class="col-6 mb-4">
    <label for="name" class="form-label">{{ __('vendors.properties.name') }} <span
            class="text-danger">*</span></label>
    <div class="input-container">
        <input type="text" class="form-control" id="name" name="name"
               placeholder="{{ __('vendors.properties.name') }}" value="{{ $vendor->name }}">
    </div>
</div>

<div class="col-6 mb-4">
    <label for="name" class="form-label">{{ __('vendors.properties.vat_number') }} <span
            class="text-danger">*</span></label>
    <div class="input-container">
        <input type="text" class="form-control" id="vat_number" name="vat_number"
               oninput="this.value = this.value.replace(/[^0-9A-Za-z]/g, '').replace(/(\..*)\./g, '$1');"
               placeholder="{{ __('vendors.properties.vat_number') }}" value="{{ $vendor->vat_number }}">
    </div>
</div>

<div class="col-6 mb-4">
    <label for="name" class="form-label">{{ __('vendors.properties.email') }} <span
            class="text-danger">*</span></label>
    <div class="input-container">
        <input type="text" class="form-control" id="email" name="email"
               placeholder="{{ __('vendors.properties.email') }}" value="{{ $vendor->email }}">
    </div>
</div>

<div class="col-6 mb-4">
    <label for="name" class="form-label">{{ __('vendors.properties.address') }} <span
            class="text-danger">*</span></label>
    <div class="input-container">
        <input type="text" class="form-control" id="address" name="address"
               placeholder="{{ __('vendors.properties.address') }}" value="{{ $vendor->address }}">
    </div>
</div>

@if (auth()->user()->isOwner())
    <div class="col-6 mb-3">
        <label for="enterprise" class="form-label">{{ __('clients.properties.enterprise') }} <span
                class="text-danger">*</span></label>
        <div class="input-container">
            <select id="enterprise-selector" class="form-select" aria-label="Default select" name="enterprise_id"
                    data-width="100%"
                    data-placeholder="{{ __('clients.properties.enterprise') }}" {{$vendor->hasRelatedEntities() ? 'readonly' : ''}}>
                @if (optional($vendor->market)->enterprise_id)
                    <option
                        value="{{ optional($vendor->market)->enterprise_id }}">
                        {{ optional(optional($vendor->market)->enterprise)->name }}</option>
                @endif
            </select>
        </div>
    </div>
@endif

<div class="col-6 mb-4">
    <label for="market" class="form-label">{{ __('vendors.properties.market') }} <span
            class="text-danger">*</span></label>
    <div class="input-container">
        <select id="market-selector" class="form-select" aria-label="Default select" name="market_id" data-width="100%"
                data-placeholder="{{ __('vendors.properties.market') }}" {{!(bool)optional($vendor->market)->enterprise_id && auth()->user()->isOwner() ? 'readonly' : '' }} {{$vendor->hasRelatedEntities() ? 'readonly' : ''}}>
            @if ($vendor->market_id)
                <option value="{{ $vendor->market_id }}">{{ $vendor->market->name }}</option>
            @endif
        </select>
    </div>
</div>

<div class="col-6 mb-4">
    <label for="country" class="form-label">{{ __('vendors.properties.country') }} <span
            class="text-danger">*</span></label>
    <div class="input-container">
        <select id="country-selector" class="form-select" aria-label="Default select" name="country_id"
                data-width="100%" data-placeholder="{{ __('vendors.properties.country') }}">
            @if (optional($vendor->city)->country_id)
                <option
                    value="{{ optional($vendor->city)->country_id }}">{{ optional(optional($vendor->city)->country)->name }}</option>
            @endif
        </select>
    </div>
</div>


<div class="col-6 mb-4">
    <label for="city" class="form-label">{{ __('vendors.properties.city') }} <span
            class="text-danger">*</span></label>
    <div class="input-container">
        <select id="city-selector" class="form-select" aria-label="Default select" name="city_id" data-width="100%"
                data-placeholder="{{ __('vendors.properties.city') }}" {{ $vendor->city ? '' : 'readonly' }}>
            @if ($vendor->city_id)
                <option value="{{ $vendor->city_id }}">{{ $vendor->city->name }}</option>
            @endif
        </select>
    </div>
</div>

{{-- <div class="col-6 mb-4">
    <label for="businessUnit" class="form-label">{{ __('vendors.properties.businessUnit') }} <span
            class="text-danger">*</span></label>
    <div class="input-container">
        <select id="business-unit-selector" class="form-select" aria-label="Default select" name="business_unit_id"
            data-width="100%" data-placeholder="{{ __('vendors.properties.businessUnit') }}" {{ auth()->user()->isOwner() ? 'readonly' : '' }}>
            @if ($vendor->businessUnit)
                <option value="{{ $vendor->businessUnit->id }}">{{ $vendor->businessUnit->name }}</option>
            @endif
        </select>
    </div>
</div> --}}

{{-- POC Person Of Contact Details --}}
<div class="col-12 mb-4">
    <div class="title-info-box">
        <span class="fs-4 fw-normal d-block">{{ __('vendors.poc') }}</span>
    </div>
</div>
<div class="poc-multi-forms">
    <div class="poc-many-forms-container">
        @forelse ($vendor->personOfContacts as $personOfContact)
            <div class="component">
                <div class="d-flex justify-content-between">
                    <h1>POC <span class="poc-num" data-index="{{$loop->iteration}}">{{$loop->iteration}}</span></h1>
                    <button style="padding:0 7px;" class="btn delete-poc-btn" type="button" aria-expanded="false">
                        <span style="color: red;" class="thinner_icon material-icons ">delete</span>
                    </button>
                </div>
                <div data-id="{{$personOfContact->id}}" class="row">
                    <div class="col-6 mb-4">
                        <label for="names_{{$personOfContact->id}}"
                               class="form-label">{{ __('vendors.properties.p_name') }}
                            <span
                                class="text-danger">*</span></label>
                        <div class="input-container">
                            <input type="text" class="form-control" id="names_{{$personOfContact->id}}"
                                   name="names[{{$personOfContact->id}}]"
                                   placeholder="{{ __('vendors.properties.p_name') }}"
                                   value="{{$personOfContact->name}}">
                        </div>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="emails_{{$personOfContact->id}}"
                               class="form-label">{{ __('vendors.properties.p_email') }} <span
                                class="text-danger">*</span></label>
                        <div class="input-container">
                            <input type="text" class="form-control" id="emails_{{$personOfContact->id}}"
                                   name="emails[{{$personOfContact->id}}]"
                                   placeholder="{{ __('vendors.properties.p_email') }}"
                                   value="{{$personOfContact->email}}">
                        </div>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="phones_{{$personOfContact->id}}"
                               class="form-label">{{ __('vendors.properties.p_phone') }} <span
                                class="text-danger">*</span></label>
                        <div class="input-container">
                            <input type="text" class="form-control" id="phones_{{$personOfContact->id}}"
                                   name="phones[{{$personOfContact->id}}]"
                                   placeholder="{{ __('vendors.properties.p_phone') }}"
                                   oninput="this.value = this.value.replace(/[^0-9.+()\-]/g, '').replace(/(\..*)\./g, '$1');"
                                   value="{{$personOfContact->phone}}">
                        </div>
                    </div>
                </div>
            </div>

        @empty
            <div class="component">
                <div class="d-flex justify-content-between">
                    <h1>POC <span class="poc-num" data-index="1">1</span></h1>
                    <button style="padding:0 7px;" class="btn delete-poc-btn" type="button" aria-expanded="false">
                        <span style="color: red;" class="thinner_icon material-icons ">delete</span>
                    </button>
                </div>
                <div data-id="1" class="row">
                    <div class="col-6 mb-4">
                        <label for="names_1" class="form-label">{{ __('vendors.properties.p_name') }} <span
                                class="text-danger">*</span></label>
                        <div class="input-container">
                            <input type="text" class="form-control" id="names_1" name="names[1]"
                                   placeholder="{{ __('vendors.properties.p_name') }}"
                                   value="">
                        </div>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="emails_1" class="form-label">{{ __('vendors.properties.p_email') }} <span
                                class="text-danger">*</span></label>
                        <div class="input-container">
                            <input type="text" class="form-control" id="emails_1" name="emails[1]"
                                   placeholder="{{ __('vendors.properties.p_email') }}"
                                   value="">
                        </div>
                    </div>

                    <div class="col-6 mb-4">
                        <label for="phones_1" class="form-label">{{ __('vendors.properties.p_phone') }} <span
                                class="text-danger">*</span></label>
                        <div class="input-container">
                            <input type="text" class="form-control" id="phones_1" name="phones[1]"
                                   placeholder="{{ __('vendors.properties.p_phone') }}"
                                   oninput="this.value = this.value.replace(/[^0-9.+()\-]/g, '').replace(/(\..*)\./g, '$1');"
                                   value="">
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
    <button type="button" class="btn float-end" id="append-new-poc-btn">Add POC</button>
</div>

