$("#manageuser").DataTable({
    "responsive": true,
    "autoWidth": false,
});
$('.manageuser').on('click', function () {
    var this_action = $(this).attr('data-action');
    var this_url = $(this).attr('data-url');
    if (this_action == 'edit') {

        $.get(this_url, function (data) {

            $('#manageusermodal').modal();
            $('#manageusermodal').on('shown.bs.modal', function () {
                $('#manageusermodal .load_modal_view').html(data);
            });

        });
    }
});
function deleteUser(id) {
    if (confirm("Are you sure to want to delete this user?")) {
        $.ajax({
            "url": "deleteuser",
            "dataType": "json",
            "data": {
                "userid": id,
                "_token": $('#csrf-token')[0].content
            },
            "type": "post",
            "success": function(response) {
                if (response.status == "success") {
                    window.location.href = "/admin/users";
                } else {
                    $("#message").css("display", "");
                    $("#message").html(response.message);
                }
            }
        })
    }
}

function suspendUser(id) {
    if (confirm("Are you sure to want to suspend this user?")) {
        $.ajax({
            "url": "suspenduser",
            "dataType": "json",
            "data": {
                "userid": id,
                "_token": $('#csrf-token')[0].content
            },
            "type": "post",
            "success": function(response) {
                if (response.status == "success") {
                    window.location.href = "/admin/users";
                } else {
                    $("#message").css("display", "");
                    $("#message").html(response.message);
                }
            }
        })
    }
}

function activateUser(id) {
    if (confirm("Are you sure to want to activate this user?")) {
        $.ajax({
            "url": "activateuser",
            "dataType": "json",
            "data": {
                "userid": id,
                "_token": $('#csrf-token')[0].content
            },
            "type": "post",
            "success": function(response) {
                if (response.status == "success") {
                    window.location.href = "/admin/users";
                } else {
                    $("#message").css("display", "");
                    $("#message").html(response.message);
                }
            }
        })
    }
}
