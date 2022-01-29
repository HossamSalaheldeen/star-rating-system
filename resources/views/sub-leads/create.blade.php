@extends('layouts.app')
@section('title', 'Sub Leads')
@section('content')
    <form method="POST" action="{{route('leads.sub-leads.store',$lead->id)}}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name *</label>
            <input type="text" id="name" name="name" class="form-control"/>
        </div>
        <input type="submit" value="Add">
    </form>
@endsection

