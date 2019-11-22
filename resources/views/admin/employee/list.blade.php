@extends('adminlte::page')
@section('title', 'Employee Management')

@section('content_header')
@include('common.alert')
    <div class="row">
        <h1>Employee List</h1>
        <div class="col-lg-12 form-inline mt-3">
            <div class="col-md-9">
                <div class="input-group">
                    <a href="{{ route('employee.create')}}"
                        class="btn btn-primary"><i class="fa fa-plus"></i>
                        &nbsp Add Employee
                    </a>
                </div>
            </div>
            <div class="col-md-3 float-right">
                <form action="" method="GET" role="search">
                <!-- {{ csrf_field() }} -->
                    <div class="input-group">
                        <input type="text" class="form-control float-right" placeholder="Search for employees"
                            name="search" value="{{ $search }}">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('content')
<div class="col-sm-12">
    <table class="table table-striped" style="overflow-x: auto; ">
        <thead>
            <tr>
            <td>Name</td>
            <td>Email</td>
            <td>SIN Number</td>
            <td>Phone</td>
            <td>Addresss</td>
            <td>Worked Type</td>
            <td>Paid Type</td>
            <td colspan="2">Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                <td>{{$employee->email}}</td>
                <td>{{$employee->sin_number}}</td>
                <td>{{$employee->phone_number}}</td>
                <td>{{$employee->address}}</td>
                <td>{{$employee->worked_type == 1 ? 'Fulltime' : 'Part-time'}}</td>
                <td>{{$employee->paid_type == 1 ? 'Hours' : 'Portion'}}</td>
                <td class="form-inline">
                    <a href="{{ route('employee.edit', $employee->id)}}"
                        class="btn btn-primary mr-1" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('employee.destroy', $employee->id)}}" class="action-btn" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" data-toggle="tooltip" title="Delete">
                            <i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="float-right">
        {{ $employees->appends(['search' => $search])->links('common.pagination') }}
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')

@stop
