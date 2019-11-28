@extends('adminlte::page')

@section('title', 'Customer Management')

@section('content_header')
    <div>
        <h1>Add Customer</h1>
    </div>
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
        <form method="POST" action="{{ route('customer.store') }}">
            @csrf
            <div class="form-group">

                <label for="first_name">First Name *</label>
                <input type="text" class="form-control" maxlength="256" name="first_name" value="{{ old('first_name') }}" />
            </div>

            <div class="form-group">
                <label for="last_name">Last Name *</label>
                <input type="text" class="form-control" maxlength="256" name="last_name" value="{{ old('last_name') }}" />
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" class="form-control" maxlength="256" name="email" value="{{ old('email') }}" />
            </div>
            <div class="form-group">
                <label for="phone_number">Phone *</label>
                <input type="text" class="form-control" maxlength="16" name="phone_number" value="{{ old('phone_number') }}" />
            </div>
            <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="text" class="date form-control" maxlength="16" readonly="readonly"
                    style="cursor:pointer; background-color: #FFFFFF"
                    id="birthday-date" name="birthday" value="{{ old('birthday') }}" />
            </div>
            <div class="form-group">
                <label for="sex">Sex</label>
                <select name="sex" class="form-control" value={{ old('sex') ?? 1 }}>
                @foreach ($sex as $sexType)
                    <option value="{{ $sexType['value'] }}" {{ ( $sexType['value'] == (old('sex')??1)) ? 'selected' : '' }}>
                        {{ $sexType['name'] }}
                    </option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" maxlength="256" name="address" value="{{ old('address') }}" />
            </div>
            <div class="form-inline justify-content-center">
                <button type="submit" class="btn btn-primary fixed-btn mr-2"><i class="fa fa-plus"></i>&nbsp Add</button>
                <a class="btn btn-primary fixed-btn" href="{{ route('customer.index') }}">
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
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    <script>
        $('#birthday-date').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    </script>
@stop
