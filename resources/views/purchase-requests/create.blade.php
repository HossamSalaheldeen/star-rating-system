@extends('layouts.app')
@section('title', 'Purchase Requests')
@section('content')
{{--    @dd(Route::is("leads.purchase-requests.create"))--}}
    <form method="POST" action="{{Route::is("leads.purchase-requests.create")
    ? route('leads.purchase-requests.store',$lead->id)
    : route('leads.sub-leads.purchase-requests.store',[$lead->id,$subLead->id])
    }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name *</label>
            <input type="text" id="name" name="name" class="form-control"/>
        </div>
        <input type="submit" value="Add">
    </form>
@endsection

