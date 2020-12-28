<form action="javascript:void(0)" method="post" id="edituser">
    <div class="modal-header">
        <h4 class="modal-title">Edit User </h4>
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

        <p>Name:</p>
        <input type="hidden" name="userid" id="userid" value="{{$user->id}}">
        <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control">
        <p>Email:</p>
        <p>
            <input type="text" name="email" id="email" class="form-control" value="{{$user->email}}" >
        </p>
        @if($user->role=='2' || $user->role=='3')
        <p>Company name:</p>
        <p>
            <input type="text" name="company_name" id="company_name" class="form-control" value="{{$user->company_name}}" >
        </p>
        @endif
        <p>Phone:</p>
        <p>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{$user->phone_number}}" >
        </p>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Save changes">
    </div>
</form>
<script>
    $("#edituser").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email:true,
                maxlength: 100,
                remote: {
                    url: "/validate_email_edit",
                    type: "post",
                    data: {
                        _token:  $('meta[name="_token"]').attr('content'),
                         id:$("#userid").val()
                    },

                }

            },
            company_name:{
                required:true
            },
            phone_number:{
                required:true
            }
        },
        messages: {

            name: {
                required: "Please enter the name",
            },
            email: {
                required: "Please enter the email",
                email: "Please enter valid email",
                remote:"This email already exists"
            },
            company_name: {
                required:"Please enter the company name"
            },
            phone_number: {
                required:"Please enter the phone number"
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: "{{ url('/admin/updateuser')}}" ,
                type: "POST",
                data: $('#edituser').serialize(),
                success: function( response ) {
                    $('#send_form').html('Submit');
                    $('#res_message').show();
                    $('#res_message').html(response.msg);
                    $('#msg_div').removeClass('d-none');

                    $("#addparentcategory")[0].reset();
                    setTimeout(function(){
                        $('#res_message').hide();
                        $('#msg_div').hide();
                        $("#addcategorymodel").modal('hide');
                    },5000);
                }
            });
        }
    })
</script>
