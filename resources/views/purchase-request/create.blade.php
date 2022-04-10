@extends('layout.app', ['title' => __('purchase-request.title')])

@section('style')
    <link rel="stylesheet" href="{{asset('/css/settings/purchase-request/index.min.css')}}"/>
@endsection

@section('content')
    <section class="users px-3">
        @include('settings.purchase-requests.create.header')
        <div class="create_content p-4 border border-3 rounded" id="purchase-request-page">
            <div class="title-info-box">
                <span class="fs-4 fw-normal">{{__('purchase-request.create-header')}}</span>
            </div>
            @include('settings.purchase-requests.create.form')
        </div>
    </section>
@endsection

@section('script')
    <script src="{{asset('/js/settings/purchase-request/create.min.js')}}"></script>
@endsection
