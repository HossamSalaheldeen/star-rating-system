@extends('layouts.app')
@section('title', 'Leads')
@section('content')
    <form method="POST" action="{{route('leads.update',$lead->id)}}">
        @method("PUT")
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name *</label>
            <input type="text" id="name" name="name" class="form-control" value="{{$lead->name}}"/>
        </div>
        <input type="submit" value="Save">
    </form>
@endsection

