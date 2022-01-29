@extends('layouts.app')
@section('title', 'Leads')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div>
                <h2>Laravel 8 CRUD Example from scratch </h2>
            </div>
            <div>
                <a class="btn btn-success" href="{{ route('leads.create') }}"> Create New Lead</a>
            </div>
        </div>
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
            @foreach ($leads as $lead)
                <tr>
                    <td>{{ $lead->name }}</td>
                    <td>
                        <div class="icons">
                            <a href="{{ route('leads.edit',$lead->id) }}" class="edit-ajax">
                                <i class="fa fa-pencil-alt"
                                   style="opacity: 0.9;font-size: 16px;margin: 0 5px;color: #808080;"></i>
                            </a>
                            <form id="delete-lead-form" style="display: none"
                                  action="{{route('leads.destroy',$lead->id)}}" method="POST">
                                @method("DELETE")
                                @csrf
                            </form>
                            <a href="javascript:function() { return false; }" onclick="$('#delete-lead-form').submit()"
                               class="delete-ajax">
                                <i class="fa fa-trash"
                                   style="opacity: 0.9;font-size: 16px;margin: 0 5px;color: #808080;"></i>
                            </a>
                            <a  href="{{ route('leads.show',$lead->id) }}">
                                <i class="fas fa-eye"
                                   style="opacity: 0.9;font-size: 16px;margin: 0 5px;color: #808080;"></i>
                            </a>
                            <a>
                                <i class="fas fa-toggle-on"
                                   style="opacity: 0.9;font-size: 16px;margin: 0 5px;color: #808080;"></i>
                            </a>
                        </div>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

