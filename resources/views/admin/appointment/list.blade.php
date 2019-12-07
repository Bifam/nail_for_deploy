@extends('adminlte::page')
@section('title', 'Task Management')

@section('content_header')
@include('common.alert')
    <div class="row">
        <h1>Task List</h1>
        <div class="col-lg-12 form-inline mt-3">
            <div class="col-md-9 col-sm-12 mb-1">
                <div class="input-group">
                    <a href="{{ route('task.create')}}"
                        class="btn btn-primary"><i class="fa fa-plus"></i>
                        &nbsp Add Task
                    </a>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 mb-1 float-right">
                <form action="" method="GET" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control float-right" placeholder="Search for tasks"
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
<div class="col-sm-12 col-md-12" style="overflow: auto; ">
    <table class="table table-striped">
        <thead>
            <tr class="d-flex">
            <td class="col-8">@sortablelink('name', 'Task Name')</td>
            <td class="col-3">@sortablelink('price', 'Price')</td>
            <td class="col-1">Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr class="d-flex">
                <td class="col-8 word-break">{{$task->name}}</td>
                <td class="col-3 word-break">{{$task->price}}</td>
                <td class="col-1 word-break form-inline">
                    <a href="{{ route('task.edit', $task->id)}}"
                        class="btn btn-primary fixed-act-btn mr-1" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>

                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$task->id}})"
                        data-target="#DeleteModal" class="btn btn-xs btn-danger fixed-act-btn"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="float-right">
        {{ $tasks->appends(['search' => $search])->links('common.pagination') }}
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
            var url = '{{ route("task.destroy", ":id") }}';
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
