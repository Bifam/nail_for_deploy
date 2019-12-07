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
                <p>{{ $error }}</p>
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
                <input type="text" class="form-control" maxlength="256" name="first_name" value="{{ old('first_name', $employee->first_name) }}" />
            </div>

            <div class="form-group">
                <label for="last_name">Last Name *</label>
                <input type="text" class="form-control" maxlength="256" name="last_name" value="{{ old('last_name', $employee->last_name) }}" />
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" class="form-control" maxlength="256" name="email" value="{{ old('email', $employee->email) }}" />
            </div>
            <div class="form-group">
                <label for="password">Password (Leave blank to keep current password)</label>
                <input type="password" class="form-control" maxlength="16" name="password" value="{{ old('password') }}" />
            </div>
            <div class="form-group">
                <label for="sin_number">SIN Number *</label>
                <input type="text" class="form-control" maxlength="16" name="sin_number" value="{{ old('sin_number', $employee->sin_number) }}" />
            </div>
            <div class="form-group">
                <label for="sex">Sex</label>
                <select name="sex" class="form-control" value={{ old('sex', $employee->sex) ?? 1 }}>
                @foreach ($sex as $sexType)
                    <option value="{{ $loop->index }}" {{ ( $loop->index == ($employee->sex??1)) ? 'selected' : '' }}>
                        {{ $sexType }}
                    </option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" maxlength="256" name="address" value="{{ old('address', $employee->address) }}" />
            </div>
            <div class="form-group">
                <label for="phone_number">Phone</label>
                <input type="number" class="form-control" maxlength="16" name="phone_number" value="{{ old('phone_number', $employee->phone_number) }}" />
            </div>
            <div class="form-group">
                <label for="worked_type">Worked Type</label>
                <select name="worked_type" class="form-control" value={{ old('worked_type', $employee->worked_type) ?? 1 }}>
                @foreach ($workedTypes as $workedType)
                    <option value="{{ $loop->index }}" {{ ( $loop->index == $employee->worked_type) ? 'selected' : '' }}>
                        {{ $workedType }}
                    </option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="paid_type">Paid Type</label>
                <select name="paid_type" class="form-control" value={{ old('paid_type', $employee->paid_type) ?? 1 }}>
                @foreach ($paidTypes as $paidType)
                    <option value="{{ $loop->index }}" {{ ( $loop->index == $employee->paid_type) ? 'selected' : '' }}>
                        {{ $paidType }}
                    </option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="salary">Salary *</label>
                <input type="number" class="form-control" min="0" max="999999" name="salary" value={{ old('salary', $employee->salary) }} />
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
