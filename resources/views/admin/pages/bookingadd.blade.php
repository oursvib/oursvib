<form action="javascript:void(0)" method="post" id="adduser">
    <div class="modal-header">
        <h4 class="modal-title">Add booking </h4>
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
        <div class="utf-no-border margin-bottom-20">
            <p>User type</p>
            <select class="form-control" name="role" id="role">
                <option value="">Select</option>
                <?php foreach($vendors as $vendor){?>
                <option value="{{$vendor->id}}">{{$vendor->company_name}}</option>
                <?php } ?>
            </select>

        </div>

        <div class="utf-no-border">
            <p>Listing </p>
            <input type="text" name="name" id="name" placeholder="Full Name" class="form-control" required="">
        </div>

        <div class="utf-no-border">
            <p>Date</p>
            <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required="">
        </div>
        <div class="utf-no-border">
            <p>Password</p>
            <input type="password" name="password" id="password"  readonly="readonly" value="Oursvib@123#" class="form-control" placeholder="Password" required="">
        </div>

        <div class="utf-no-border" id="company_name_div">
            <p>Company name</p>
            <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company name" required="">
        </div>
        <div class="utf-no-border">
            <p>Phone number</p>
            <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone number" required="">
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
