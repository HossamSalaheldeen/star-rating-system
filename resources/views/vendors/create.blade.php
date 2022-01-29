@extends('layouts.app')
@section('title', 'Vendors')
@section('style')
    <link rel="stylesheet" href="{{asset('/css/rating.min.css')}}">
@endsection
@section('content')
    <form id="add-vendor-rating" method="POST" action="{{route('vendors.store')}}">
        @csrf
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="name" class="form-label">Name *</label>
                <input type="text" id="name" name="name" class="form-control"/>
            </div>

            <div class="col-md-6 col-sm-12 mb-3">
                <label for="name" class="form-label">Rating *</label>
                @include('vendors.rating')
            </div>
        </div>
        <input type="submit" value="Add">
    </form>
@endsection

@section('script')
    <script src="{{asset('js/rating.min.js')}}"></script>
    <script src="{{asset('js/vendors/create.min.js')}}"></script>
@endsection
