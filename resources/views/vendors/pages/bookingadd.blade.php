
<form action="javascript:void(0)" method="post" id="blockbooking">
    <div class="modal-header">
        <h4 class="modal-title">Block dates </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success d-none" id="msg_div">
                    <span id="res_message"></span>
                </div>
                <div class="alert alert-danger d-none" id="err_div">
                    <span id="err_message"></span>
                </div>
            </div>
        </div>

        @csrf
        <div class="utf-no-border margin-bottom-20">
            <p>Listings</p>
            <select class="form-control" name="listing" id="listing">
                <option value="">Select</option>
                <?php foreach($listings as $listing){?>
                <option value="{{$listing->id}}">{{$listing->title}}</option>
                <?php } ?>
            </select>

        </div>
        <div class="utf-no-border">
            <p>Date From</p>
            <div class="input-append date" id="datetimepickerfrom" data-date="{{ date('d-m-Y H:i')}}" data-date-format="dd-mm-yyyy hh:ii">
                <input class="form-control" name="datetimepickerfrom" size="16" type="text" value="{{ date('d-m-Y H:i')}}" >
                <span class="add-on"><i class="icon-th"></i></span>
            </div>
            <p>Date To</p>
            <div class="input-append date" id="datetimepickerto" data-date="{{ date('d-m-Y H:i')}}" data-date-format="dd-mm-yyyy hh:ii">
                <input class="form-control" name="datetimepickerto"  size="16" type="text" value="{{ date('d-m-Y H:i')}}" >
                <span class="add-on"><i class="icon-th"></i></span>
            </div>
        </div>

    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Save changes">
    </div>
</form>
<script>

    $("#role").change(function(){
        if($(this).val()=='4'){
            $("#company_name_div").hide();
        }else{
            $("#company_name_div").show();
        }
    })
    $('#datetimepickerfrom,#datetimepickerto').datetimepicker({
        startDate:new Date()
    });


    $("#blockbooking").validate({
        rules: {
            listing: {
                required: true
            },
            datetimepickerfrom: {
                required: true
            },
            datetimepickerto: {
                required: true
            }

        },
        submitHandler: function (form) {
            //event.preventDefault();
            $.ajax({
                url: "{{url('/vendors/blockbooking')}}" ,
                type: "POST",
                data: $('#blockbooking').serialize(),
                success: function( response ) {
                    //  $('#send_form').html('Submit');
                    $('#res_message,#err_message').hide();
                    if(response.status=="success") {
                        $('#res_message').show();
                        $('#err_message').hide();
                        $('#res_message').html(response.message);
                        $('#msg_div').removeClass('d-none');
                    }else{
                        $('#res_message').hide();
                        $('#err_message').show();
                        $('#err_message').html(response.message);
                        $('#err_div').removeClass('d-none');
                    }
                    $("#blockbooking")[0].reset();
                    setTimeout(function(){
                        $('#res_message,#err_message').hide();
                        $('#msg_div').hide();
                        $("#manageusermodal").modal('hide');
                        window.location.reload();
                    },3000);

                }
            });
        }
    })
</script>
