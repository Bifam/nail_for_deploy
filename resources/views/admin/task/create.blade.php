@extends('adminlte::page')

@section('title', 'Task Management')

@section('content_header')
    <div>
        <h1>Add Task</h1>
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
        <form method="POST" action="{{ route('task.store') }}">
            @csrf
            <div class="form-group">

                <label for="name">Task Name *</label>
                <input type="text" class="form-control" maxlength="256" name="name" value="{{ old('name') }}" />
            </div>

            <div class="form-group">
                <label for="price">Price *</label>
                <input type="number" class="form-control" min="0" max="999999" name="price" value="{{ old('price') }}" />
            </div>
            <div class="form-inline justify-content-center">
                <button type="submit" class="btn btn-primary fixed-btn mr-2"><i class="fa fa-plus"></i>&nbsp Add</button>
                <a class="btn btn-primary fixed-btn" href="{{ route('task.index') }}">
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
