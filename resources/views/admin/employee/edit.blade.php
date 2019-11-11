@extends('adminlte::page')

@section('title', 'Employee Management')

@section('content_header')
    <div>
        <h1 class="display-inline">Edit Employee Information</h1>
        <a class="btn btn-primary display-inline align-right" href={{ url()->previous() }}>Back</a>
    </div>
@stop

@section('content')
<div class="row">
    <div class="col-sm-10 offset-md-1">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br />
        @endif
        <form method="post" action="{{ route('employee.update', $employee->id) }}">
            @method('PATCH')
            @csrf
            <div class="form-group">

                <label for="first_name">First Name</label>
                <input type="text" class="form-control" maxlength="256" name="first_name" value="{{ $employee->first_name }}" />
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" maxlength="256" name="last_name" value="{{ $employee->last_name }}" />
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" maxlength="256" name="email" value="{{ $employee->email }}" />
            </div>
            <div class="form-group">
                <label for="sin_number">SIN Number</label>
                <input type="text" class="form-control" maxlength="16" name="sin_number" value={{ $employee->sin_number }} />
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" maxlength="256" name="address" value="{{ $employee->address }}" />
            </div>
            <div class="form-group">
                <label for="phone_number">Phone</label>
                <input type="number" class="form-control" maxlength="16" name="phone_number" value={{ $employee->phone_number }} />
            </div>
            <div class="form-group">
                <label for="worked_type">Worked Type</label>
                <select name="worked_type" class="form-control" value={{ $employee->worked_type }}>
                @foreach ($workedTypes as $workedType)
                    <option value="{{ $workedType['value'] }}" {{ ( $workedType['value'] == $employee->worked_type) ? 'selected' : '' }}>
                        {{ $workedType['name'] }}
                    </option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="paid_type">Paid Type</label>
                <select name="paid_type" class="form-control" value={{ $employee->paid_type }}>
                @foreach ($paidTypes as $paidType)
                    <option value="{{ $paidType['value'] }}" {{ ( $paidType['value'] == $employee->paid_type) ? 'selected' : '' }}>
                        {{ $paidType['name'] }}
                    </option>
                @endforeach
                </select>
            </div>
            <div class="form-group align-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/common.css">
@stop

@section('js')

@stop
