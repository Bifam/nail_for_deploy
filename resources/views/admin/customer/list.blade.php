@extends('adminlte::page')
@section('title', 'Customer Management')

@section('content_header')
@include('common.alert')
    <div class="row">
        <h1>Customer List</h1>
        <div class="col-lg-12 form-inline mt-3">
            <div class="col-md-9 col-sm-12 mb-1">
                <div class="input-group">
                    <a href="{{ route('customer.create')}}"
                        class="btn btn-primary"><i class="fa fa-plus"></i>
                        &nbsp Add Customer
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 mb-1 float-right">
                <form action="" method="GET" role="search">
                <!-- {{ csrf_field() }} -->
                    <div class="input-group">
                        <input type="text" class="form-control float-right" placeholder="Search for customers"
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
                <td class="col-3">@sortablelink('email', 'Email')</td>
                <td class="col-1">@sortablelink('phone_number', 'Phone')</td>
                <td class="col-1">@sortablelink('birthday', 'Birthday')</td>
                <td class="col-1">@sortablelink('sex', 'Sex')</td>
                <td class="col-3">@sortablelink('address', 'Addresss')</td>
                <td class="col-1">Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr class="d-flex">
                <td class="col-2 word-break">{{$customer->first_name}} {{$customer->last_name}}</td>
                <td class="col-3 word-break">{{$customer->email}}</td>
                <td class="col-1 word-break">{{$customer->phone_number}}</td>
                <td class="col-1 word-break">{{$customer->birthday}}</td>
                <td class="col-1 word-break">{{$sex[$customer->sex]}}</td>
                <td class="col-3 word-break">{{$customer->address}}</td>
                <td class="col-1 word-break form-inline">
                    <a href="{{ route('customer.edit', $customer->id)}}"
                        class="btn btn-primary fixed-act-btn mr-1" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>

                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$customer->id}})"
                        data-target="#DeleteModal" class="btn btn-danger fixed-act-btn"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="float-right">
        {{ $customers->appends(['search' => $search])->links('common.pagination') }}
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
            var url = '{{ route("customer.destroy", ":id") }}';
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
