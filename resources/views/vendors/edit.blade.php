@extends('layouts.app')
@section('title', 'Vendors')
@section('style')
    <link rel="stylesheet" href="{{asset('/css/rating.min.css')}}">
@endsection
@section('content')
    <form id="edit-vendor-rating" method="POST" action="{{route('vendors.update',$vendor->id)}}">
        @method("PUT")
        @csrf
        <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
                <label for="name" class="form-label">Name *</label>
                <input type="text" id="name" name="name" class="form-control" value="{{$vendor->name}}"/>
            </div>

            <div class="col-md-6 col-sm-12 mb-3">
                <label for="name" class="form-label">Rating *</label>
                @include('vendors.edit.rating')
            </div>
        </div>
        <input type="submit" value="Save">
    </form>
@endsection

@section('script')
    <script src="{{asset('js/rating.min.js')}}"></script>
    <script src="{{asset('js/vendors/edit.min.js')}}"></script>
@endsection
