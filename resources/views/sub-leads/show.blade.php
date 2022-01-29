@extends('layouts.app')
@section('title', 'Sub Leads')
@section('content')
    <div>
        Sub Lead Name: {{$subLead->name}}
    </div>
    <div>
        <a class="btn btn-success" href="{{ route('leads.sub-leads.purchase-requests.create',[$lead->id,$subLead->id]) }}"> Create New Purchase Request</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($purchaseRequests as $purchaseRequest)
                <tr>
                    <td>{{ $purchaseRequest->name }}</td>
                    {{--                    <td>--}}
                    {{--                        <div class="icons">--}}
                    {{--                            <a href="{{ route('leads.sub-leads.edit',[$lead->id,$subLead->id]) }}" class="edit-ajax">--}}
                    {{--                                <i class="fa fa-pencil-alt"--}}
                    {{--                                   style="opacity: 0.9;font-size: 16px;margin: 0 5px;color: #808080;"></i>--}}
                    {{--                            </a>--}}
                    {{--                            <form id="delete-lead-form" style="display: none"--}}
                    {{--                                  action="{{route('leads.sub-leads.destroy',[$lead->id,$subLead->id])}}" method="POST">--}}
                    {{--                                @method("DELETE")--}}
                    {{--                                @csrf--}}
                    {{--                            </form>--}}
                    {{--                            <a href="javascript:function() { return false; }" onclick="$('#delete-lead-form').submit()"--}}
                    {{--                               class="delete-ajax">--}}
                    {{--                                <i class="fa fa-trash"--}}
                    {{--                                   style="opacity: 0.9;font-size: 16px;margin: 0 5px;color: #808080;"></i>--}}
                    {{--                            </a>--}}
                    {{--                            <a  href="{{ route('leads.sub-leads.show',[$lead->id,$subLead->id]) }}">--}}
                    {{--                                <i class="fas fa-eye"--}}
                    {{--                                   style="opacity: 0.9;font-size: 16px;margin: 0 5px;color: #808080;"></i>--}}
                    {{--                            </a>--}}
                    {{--                            <a>--}}
                    {{--                                <i class="fas fa-toggle-on"--}}
                    {{--                                   style="opacity: 0.9;font-size: 16px;margin: 0 5px;color: #808080;"></i>--}}
                    {{--                            </a>--}}
                    {{--                        </div>--}}

                    {{--                    </td>--}}
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

