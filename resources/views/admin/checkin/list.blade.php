@extends('adminlte::page')
@section('title', 'Check in/out Management')

@section('content_header')
@include('common.alert')
    <div class="row">
        <h1>Employee Checkin/out</h1>
        <div class="col-lg-12 form-inline mt-3">
            <div class="col-sm-12 mb-1 float-right">
                <form action="" method="GET" role="search">
                <!-- {{ csrf_field() }} -->
                    <div class="input-group float-right">
                        <input type="text" class="date form-control" maxlength="16" readonly="readonly"
                            style="cursor:pointer; background-color: #FFFFFF"
                            id="checkin-date" name="date" value="{{ old('date', $search) }}" />
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
@include('common.checkinmodal')
<div class="col-sm-12 col-md-12 table-responsive" style="overflow: auto;">
    <table class="table table-striped table-bordered table-hover w-100">
        <thead>
            <tr class="d-flex">
                <td class="col-5">@sortablelink('first_name', 'Name')</td>
                <td class="col-2">@sortablelink('checkin.checkin_date', 'Date')</td>
                <td class="col-2">@sortablelink('checkin.in_time', 'Checkin Time')</td>
                <td class="col-2">@sortablelink('checkin.out_time', 'Checkout Time')</td>
                <td class="col-1">Actions</td>
            </tr>
        </thead>
        <tbody>
            @foreach($checkins as $checkin)
            <tr class="d-flex">
                <td class="col-5 word-break">{{$checkin->first_name}} {{$checkin->last_name}}</td>
                <td class="col-2 word-break">{{ !empty($checkin->checkin) ? $checkin->checkin->checkin_date : ''}}</td>
                <td class="col-2 word-break">{{ !empty($checkin->checkin) ?  $checkin->checkin->in_time : ''}}</td>
                <td class="col-2 word-break">{{ !empty($checkin->checkin) ? $checkin->checkin->out_time : ''}}</td>
                <td class="col-1 word-break form-inline">
                    <a href="javascript:;" data-toggle="modal" data-target="#CheckinModal" data-id="{{ $checkin->id }}"
                        data-intime="{{ !empty($checkin->checkin) ?  $checkin->checkin->in_time : '' }}" 
                        data-outtime="{{ !empty($checkin->checkin) ? $checkin->checkin->out_time : '' }}" 
                        class="btn btn-xs btn-primary fixed-act-btn"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="float-right">
        {{ $checkins->appends(['search' => $search])->links('common.pagination') }}
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    <script>
        $('#checkin-date').datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $('#in_time').datetimepicker({});
        
        $('#CheckinModal').on('show.bs.modal', function(e) {
            var link     = $(e.relatedTarget),
                modal    = $(this),
                id = link.data("id"),
                inTime = link.data("intime"),
                outTime    = link.data("outtime");
            modal.find("#in_time").val(inTime);
            modal.find("#out_time").val(outTime);
        });
    </script>
@stop