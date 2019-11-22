@extends('adminlte::page')

@section('title', 'Employee Management')

@section('content_header')
        <h1 class="display-inline">Edit Employee</h1>
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
            @method('PUT')
            @csrf
            <div class="form-group">

                <label for="first_name">First Name *</label>
                <input type="text" class="form-control" maxlength="256" name="first_name" value="{{ $employee->first_name }}" />
            </div>

            <div class="form-group">
                <label for="last_name">Last Name *</label>
                <input type="text" class="form-control" maxlength="256" name="last_name" value="{{ $employee->last_name }}" />
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="text" class="form-control" maxlength="256" name="email" value="{{ $employee->email }}" />
            </div>
            <div class="form-group">
                <label for="password">Password (Leave blank to keep current password)</label>
                <input type="password" class="form-control" maxlength="16" name="password" value="{{ old('password') }}" />
            </div>
            <div class="form-group">
                <label for="sin_number">SIN Number *</label>
                <input type="text" class="form-control" maxlength="16" name="sin_number" value={{ $employee->sin_number }} />
            </div>
            <div class="form-group">
                <label for="sex">Sex</label>
                <select name="sex" class="form-control" value={{ $employee->sex??1 }}>
                @foreach ($sex as $sexType)
                    <option value="{{ $sexType['value'] }}" {{ ( $sexType['value'] == ($employee->sex??1)) ? 'selected' : '' }}>
                        {{ $sexType['name'] }}
                    </option>
                @endforeach
                </select>
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
            <div class="form-group">
                <label for="salary">Salary *</label>
                <input type="number" class="form-control" maxlength="16" name="salary" value={{ $employee->salary }} />
            </div>
            <div class="form-inline justify-content-center">
                <button type="submit" class="btn btn-primary fixed-btn mr-2"><i class="fa fa-edit"></i>&nbsp Update</button>
                <a class="btn btn-primary fixed-btn" href="{{ route('employee.index') }}">
                    <i class="fa fa-arrow-left"></i>&nbsp Back
                </a>
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
