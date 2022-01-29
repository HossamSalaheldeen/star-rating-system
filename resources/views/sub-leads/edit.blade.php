@extends('layouts.app')
@section('title', 'Leads')
@section('content')
    <form method="POST" action="{{route('leads.sub-leads.update',[$lead->id,$subLead->id])}}">
        @method("PUT")
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name *</label>
            <input type="text" id="name" name="name" class="form-control" value="{{$subLead->name}}"/>
        </div>
        <input type="submit" value="Save">
    </form>
@endsection

