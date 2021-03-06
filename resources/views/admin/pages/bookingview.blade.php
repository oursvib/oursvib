<form action="javascript:void(0)" method="post" id="adduser">
    <div class="modal-header">
        <h4 class="modal-title">Booking details of {{$bookingdetails->booking_ref_no}} </h4>
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
            </div>
        </div>

        @csrf


        <div class="utf-no-border">
            <p><strong>Booked by</strong></p>
            <p>{{$bookingdetails->bookedusername}}</p>
        </div>

 				<div class="utf-no-border">
            <p><strong>Booked user email</strong></p>
            <p>{{$bookingdetails->bookeduseremail}}</p>
        </div>
         <div class="utf-no-border">
            <p><strong>Booking Reference ID</strong></p>
            <p>{{$bookingdetails->booking_ref_no}}</p>
        </div>
         <div class="utf-no-border">
            <p><strong>Listing Title</strong></p>
            <p>{{$bookingdetails->title}}</p>
        </div>
         <div class="utf-no-border">
            <p><strong>Vendor Company</strong></p>
            <p>{{$bookingdetails->company_name}} -- ({{$bookingdetails->vendoremail}})</p>
        </div>
        <div class="utf-no-border">
            <p><strong>Booking start date</strong></p>
            <p>{{$bookingdetails->start_date}}</p>
        </div>
        <div class="utf-no-border">
            <p><strong>Booking end date</strong></p>
            <p>{{$bookingdetails->end_date}}</p>
        </div>
        <div class="utf-no-border">
            <p><strong>Booked on</strong></p>
            <p>{{$bookingdetails->bookingdate}}</p>
        </div>
         <div class="utf-no-border">
            <p><strong>Blocked by Vendor</strong></p>
            <p>
                @if($bookingdetails->vendor_id==$bookingdetails->user_id && $bookingdetails->blockings==1)
                    Yes
                @else
                    No
                @endif

            </p>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       <!-- <input type="submit" class="btn btn-primary" value="Save changes">-->
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


    $("#adduser").validate({
        rules: {
            role: {
                required: true
            },
            name: {
                required: true
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "/validate_email_add",
                    type: "post",
                    data: {
                        "_token": $('#csrf-token')[0].content
                    },

                }
            },
            passwordr: {
                required: true
            },
            company_name: {
                required: true
            },
            phone_number: {
                required: true
            }
        },
        messages:{
            email:{
                remote:"This email already exists"
            }
        },
        submitHandler: function (form) {
            //event.preventDefault();
            $.ajax({
                url: "{{url('/admin/saveuser')}}" ,
                type: "POST",
                data: $('#adduser').serialize(),
                success: function( response ) {
                    //  $('#send_form').html('Submit');
                    $('#res_message').show();
                    $('#res_message').html(response.message);
                    $('#msg_div').removeClass('d-none');

                    $("#adduser")[0].reset();
                    setTimeout(function(){
                        $('#res_message').hide();
                        $('#msg_div').hide();
                        $("#manageusermodal").modal('hide');
                        window.location.reload();
                    },3000);

                }
            });
        }
    })
</script>
