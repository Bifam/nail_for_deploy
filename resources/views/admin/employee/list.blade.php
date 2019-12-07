@extends('adminlte::page')
@section('title', 'Employee Management')

@section('content_header')
@include('common.alert')
    <div class="row">
        <h1>Employee List</h1>
        <div class="col-lg-12 form-inline mt-3">
            <div class="col-md-9 col-sm-12 mb-1">
                <div class="input-group">
                    <a href="{{ route('employee.create')}}"
                        class="btn btn-primary"><i class="fa fa-plus"></i>
                        &nbsp Add Employee
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 mb-1 float-right">
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
@include('common.delmodal')
<div class="col-sm-12 col-md-12 table-responsive" style="overflow: auto;">
    <table class="table table-striped table-bordered table-hover w-100">
        <thead>
            <tr class="d-flex">
                <td class="col-2">@sortablelink('first_name', 'Name')</td>
                <td class="col-2">@sortablelink('email', 'Email')</td>
                <td class="col-1">@sortablelink('sin_number', 'SIN Number')</td>
                <td class="col-1">@sortablelink('phone', 'Phone')</td>
                <td class="col-1">@sortablelink('sex', 'Sex')</td>
                <td class="col-2">@sortablelink('address', 'Addresss')</td>
                <td class="col-1">@sortablelink('worked_type', 'Worked Type')</td>
                <td class="col-1">@sortablelink('paid_type', 'Paid Type')</td>
                <td class="col-1">Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr class="d-flex">
                <td  class="col-2 word-break">{{$employee->first_name}} {{$employee->last_name}}</td>
                <td  class="col-2 word-break">{{$employee->email}}</td>
                <td  class="col-1 word-break">{{$employee->sin_number}}</td>
                <td  class="col-1 word-break">{{$employee->phone_number}}</td>
                <td  class="col-1 word-break">{{$sex[$employee->sex]}}</td>
                <td  class="col-2 word-break">{{$employee->address}}</td>
                <td  class="col-1 word-break">{{$employee->worked_type == 1 ? 'Fulltime' : 'Part-time'}}</td>
                <td  class="col-1 word-break">{{$employee->paid_type == 1 ? 'Hours' : 'Portion'}}</td>
                <td  class="col-1 word-break form-inline">
                    <a href="{{ route('employee.edit', $employee->id)}}"
                        class="btn btn-primary fixed-act-btn mr-1" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>

                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$employee->id}})"
                        data-target="#DeleteModal" class="btn btn-xs btn-danger fixed-act-btn"><i class="fa fa-trash"></i></a>
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
    <script type="text/javascript">
        function deleteData(id)
        {
            var id = id;
            var url = '{{ route("employee.destroy", ":id") }}';
            url = url.replace(':id', id);
            console.log(url);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>
@stop
