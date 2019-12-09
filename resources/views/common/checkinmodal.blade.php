<div id="CheckinModal" class="modal fade text-primary" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <form action="" id="checkinForm" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-center">Checkin/Checkout</h4>
                    <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="form-group">
                        <label for="in_time">Checkin Time</label>
                        <input type="text" class="date form-control pick_time" maxlength="16" readonly="readonly"
                            style="cursor:pointer; background-color: #FFFFFF"
                            id="in_time" name="in_time" />
                    </div>
                    <div class="form-group">
                        <label for="out_time">Checkout Time</label>
                        <input type="text" class="date form-control pick_time" maxlength="16" readonly="readonly"
                            style="cursor:pointer; background-color: #FFFFFF"
                            id="out_time" name="out_time" />
                    </div>
                </div>
                <div class="modal-footer">
                    <center>
                        <button type="submit" name="" class="btn btn-primary fixed-btn"
                            data-dismiss="modal" onclick="formSubmit()">Update</button>
                        <button type="button" class="btn btn-primary fixed-btn" data-dismiss="modal">Cancel</button>
                    </center>
                </div>
            </div>
        </form>
    </div>
</div>