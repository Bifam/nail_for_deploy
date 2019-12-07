<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Appointment List</title>


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="col-sm-12 col-md-12" style="overflow: auto; ">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <td>@sortablelink('name', 'Task Name')</td>
                            <td>@sortablelink('price', 'Price')</td>
                            <td colspan="2">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $task)
                            <tr>
                                <td>{{$task->name}}</td>
                                <td>{{$task->price}}</td>
                                <td class="form-inline">
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
            </div>
        </div>
    </body>
</html>
