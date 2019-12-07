@extends('adminlte::page')

@section('title', 'Appointment Management')

@section('content_header')
    <div>
        <h1>Add Appointment</h1>
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
        <form method="POST" action="{{ route('appointment.store') }}">
            @csrf
            <div class="form-group">
                <label for="customer_id">Customer's Phone *</label>
                <div class="form-inline">
                    <select class="form-control col-md-5" name="customer_id" id="customer_id" value="{{ old('customer') }}">
                        <option value="AL">Alabama</option>
                        <option value="WY">Wyoming</option>
                    </select>
                    <p class="col-md-1 text-center"> - </p>
                    <input type="text" class="form-control col-md-6" value="{{ old('customer') }}" disabled />
                </div>
            </div>

            <div class="form-group">
                <label for="employee_id">Employee *</label>
                <input type="select" class="form-control" name="employee_id" value="{{ old('employee') }}" />
            </div>
            <div class="form-group">
                <label for="status">Status *</label>
                <input type="select" class="form-control" name="status" value="{{ old('price') }}" />
            </div>
            <div class="form-inline justify-content-center">
                <button type="submit" class="btn btn-primary fixed-btn mr-2"><i class="fa fa-plus"></i>&nbsp Add</button>
                <a class="btn btn-primary fixed-btn" href="{{ route('appointment.index') }}">
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
    <script type="text/javascript">
        $("#customer_id").select2({
            theme: "bootstrap"
        });
    </script>
@stop
