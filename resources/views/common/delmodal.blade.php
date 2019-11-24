<div id="DeleteModal" class="modal fade text-danger" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-center">Delete Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <p class="text-center">Are you sure want to delete ?</p>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="submit" name="" class="btn btn-danger fixed-btn"
                            data-dismiss="modal" onclick="formSubmit()">Yes</button>
                        <button type="button" class="btn btn-primary fixed-btn" data-dismiss="modal">Cancel</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>

@section('css')
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/common.css">
@stop
