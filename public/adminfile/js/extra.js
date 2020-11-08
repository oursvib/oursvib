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
