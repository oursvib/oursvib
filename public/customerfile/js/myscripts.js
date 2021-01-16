$("#login-form").validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        password: {
            required: true
        }
    },
    submitHandler: function (form) {
        event.preventDefault();
        $.ajax({
            url: "login",
            type: "POST",
            data: $("#login-form").serialize(),
            dataType: "json",
            success: function (data) {
                if (data.status == "success") {
                    window.location.href = data.redirectto
                }
            },
            error: function (data) {
                $("#errors").html(data.responseJSON.errors.email)
            }
        })
    }
});

$("#role").change(function(){
    if($(this).val()=='4'){
        $("#company_name_div").hide();
    }else{
        $("#company_name_div").show();
    }
})
$("#register-form").validate({
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
                url: "/validate_email",
                type: "post",
                data: {
                    _token:  $('meta[name="_token"]').attr('content')
                },

            }
        },
        passwordr: {
            required: true
        },
        password_confirmation: {
            required: true,
            equalTo: '#passwordr'
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
       form.submit();
        // $.ajax({
        //     url: "register",
        //     type: "POST",
        //     data: $("#register-form").serialize(),
        //     dataType: "json",
        //     success: function (data) {
        //         if (data.status == "success") {
        //             window.location.href = data.redirectto
        //         }
        //     },
        //     error: function (data) {
        //         $("#errors").html(data.responseJSON.errors.email)
        //     }
        // })
    }
});

$("#countrylist").on('change',function(){
    var countryid=$(this).val();
    $.ajax({
        "url":"setcountry",
        "data":{countryid:countryid, _token:  $('meta[name="_token"]').attr('content')},
        "type":"POST",
        "dataType":"json",
        "success":function(data){
            if(data.status=="success"){
                window.location.reload();
            }else{
                window.location.reload();
            }
        }
    })
});