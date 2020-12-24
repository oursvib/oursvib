$("#managelisting").DataTable({
    "responsive": true,
    "autoWidth": false,
});
tinymce.init({
    selector: "#description,#team,#aboutus"
});
// $("#addlistingwizard").steps({
//     headerTag:"h3",
//     bodyTag: "fieldset",
//     onFinished: function (event, currentIndex)
//     {
//         $('#addlistingwizard').ajaxSubmit({url:"savelisting",type:"post"})
//     }
// });
$(document).ready(function() {
    $(".select2").select2();
});

function deleteListing(id) {
    if (confirm("Are you sure to want to delete this listing?")) {
        $.ajax({
            "url": "deletelisting",
            "dataType": "json",
            "data": {
                "listingid": id,
                "_token": $('#csrf-token')[0].content
            },
            "type": "post",
            "success": function(response) {
                if (response.status == "success") {
                    window.location.href = "/admin/managelisting";
                } else {
                    $("#message").css("display", "");
                    $("#message").html(response.message);
                }
            }
        })
    }
}

function unapproveListing(id) {
    if (confirm("Are you sure to want to suspend this listing?")) {
        $.ajax({
            "url": "deletelisting",
            "dataType": "json",
            "data": {
                "listingid": id,
                "_token": $('#csrf-token')[0].content
            },
            "type": "post",
            "success": function(response) {
                if (response.status == "success") {
                    window.location.href = "/admin/managelisting";
                } else {
                    $("#message").css("display", "");
                    $("#message").html(response.message);
                }
            }
        })
    }
}

function approveListing(id) {
    if (confirm("Are you sure to want to approve this listing?")) {
        $.ajax({
            "url": "deletelisting",
            "dataType": "json",
            "data": {
                "listingid": id,
                "_token": $('#csrf-token')[0].content
            },
            "type": "post",
            "success": function(response) {
                if (response.status == "success") {
                    window.location.href = "/admin/managelisting";
                } else {
                    $("#message").css("display", "");
                    $("#message").html(response.message);
                }
            }
        })
    }
}