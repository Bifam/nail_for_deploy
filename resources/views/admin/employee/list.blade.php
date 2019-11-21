@extends('adminlte::page')

@section('title', 'Employee Management')

@section('content_header')
    <h1>Employee List</h1>
@stop

@section('content')
<div class="col-sm-12">
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Name</td>
          <td>Email</td>
          <td>SIN Number</td>
          <td>Phone</td>
          <td>Addresss</td>
          <td>Worked Type</td>
          <td>Paid Type</td>
          <td>Actions</td>
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
            <td>
                <a href="{{ route('employee.edit', $employee->id)}}"
                    class="btn btn-primary display-inline" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                <form action="{{ route('employee.destroy', $employee->id)}}" class="display-inline" method="post">
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
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')

@stop
