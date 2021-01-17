// $("#addlistingwizard").steps({
//     headerTag: "h3",
//     bodyTag: "fieldset",
//     onFinished: function(event, currentIndex) {
//         $('#addlistingwizard').ajaxSubmit({
//             url: "savelisting",
//             type: "post"
//         })
//     }
// });
var form = $("#addlistingwizard").show();
form.steps({
    headerTag: "h3",
    bodyTag: "fieldset",
    transitionEffect: "slideLeft",
    onStepChanging: function(event, currentIndex, newIndex) {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex) {
            return true;
        }
        // Forbid next action on "Warning" step if the user is to young
        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex) {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled,:hidden:not(textarea)";
        for (i = 0; i < tinymce.editors.length; i++) {
            var content = tinymce.editors[i].getContent(); // get the content
            console.log($('#' + tinymce.editors[i].id))
            $('#' + tinymce.editors[i].id).val(content); // put it in the textarea
        }
        return form.valid();
    },
    onStepChanged: function(event, currentIndex, priorIndex) {
        // Used to skip the "Warning" step if the user is old enough.
        // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
    },
    onFinishing: function(event, currentIndex) {
        form.validate().settings.ignore = ":disabled,:hidden:not(textarea)";
        return form.valid();
    },
    onFinished: function(event, currentIndex) {
        $('#addlistingwizard').ajaxSubmit({
            "url": "savelisting",
            "type": "post",
            "dataType": "json",
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
}).validate({
    errorPlacement: function errorPlacement(error, element) {
        //element.insertAfter(error);
        if (element.type == "textarea") {
            error.appendTo(element.next());
        } else {
            error.appendTo(element.parent('div'))
        }
    },
})
var form1 = $("#editlistingwizard").show();
form1.steps({
    headerTag: "h3",
    bodyTag: "fieldset",
    transitionEffect: "slideLeft",
    onStepChanging: function(event, currentIndex, newIndex) {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex) {
            return true;
        }
        // Forbid next action on "Warning" step if the user is to young
        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex) {
            // To remove error styles
            form1.find(".body:eq(" + newIndex + ") label.error").remove();
            form1.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form1.validate().settings.ignore = ":disabled,:hidden:not(textarea)";
        for (i = 0; i < tinymce.editors.length; i++) {
            var content = tinymce.editors[i].getContent(); // get the content
            console.log($('#' + tinymce.editors[i].id))
            $('#' + tinymce.editors[i].id).val(content); // put it in the textarea
        }
        return form1.valid();
    },
    onStepChanged: function(event, currentIndex, priorIndex) {
        // Used to skip the "Warning" step if the user is old enough.
        // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
    },
    onFinishing: function(event, currentIndex) {
        form1.validate().settings.ignore = ":disabled,:hidden:not(textarea)";
        return form1.valid();
    },
    onFinished: function(event, currentIndex) {
        $('#editlistingwizard').ajaxSubmit({
            "url": "updatelisting",
            "type": "post",
            "dataType": "json",
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
}).validate({
    errorPlacement: function errorPlacement(error, element) {
        //element.insertAfter(error);
        if (element.type == "textarea") {
            error.appendTo(element.next());
        } else {
            error.appendTo(element.parent('div'))
        }
    },
})
$(".addnearby").click(function() {
    var itemcount = $("#itemcountnew").val();
    var itemcountnewadd = parseInt(itemcount) + 1;
    $("#itemcountnew").val(itemcountnewadd);
    var itemcountnew = $("#itemcountnew").val();
    var element = '<div class="col-md-12 mainitem"><div class="col-md-5 nearby"><input type="text" name="nearby[' + itemcountnew + '][location]" class="form-control" placeholder="location"><input type="hidden" name="nearby[' + itemcountnew + '][nearbyid]" class="form-control" value="0"></div><div class="col-md-5 nearby"><input type="text" name="nearby[' + itemcountnew + '][distance]" class="form-control" placeholder="distance in KM"></div><div class="col-md-1 nearby"><input type="button" value="X" class="btn btn-danger removenearby"></div><br><br></div>'
    $(".nearbyattraction").append(element);
    //$("#mainitem").clone().attr('id','').appendTo(".nearbyattraction").find("input:text").val("");
})
$(".addpricing").click(function() {
    var pricecount = $("#pricecountnew").val();
    if (pricecount < 3) {
        var pricecountnewadd = parseInt(pricecount) + 1;
        $("#pricecountnew").val(pricecountnewadd);
        var pricecountnew = $("#pricecountnew").val();
        var element = '<div class="col-md-12"><div class="col-md-2 mb-3 pricing"><select class="form-control select2 required" name="price[' + pricecountnew + '][billing_type]" id="billing_type_' + pricecountnew + '"><option value="">select</option><option value="1">Hourly</option><option value="2">12 hour</option><option value="3">24 hour</option><option value="4">Daily</option> </select></div><div class="col-md-2 mb-3 pricing"><div class="col-xs-1"> <select class="form-control required peakstart" name="price[' + pricecountnew + '][peakstart]" id="peakstart_' + pricecountnew + '"><option value="">From</option><option value="1">Jan</option><option value="2">Feb</option><option value="3">Mar</option><option value="4">Apr</option><option value="5">May</option><option value="6">Jun</option><option value="7">Jul</option><option value="8">Aug</option><option value="9">Sep</option><option value="10">Oct</option><option value="11">Nov</option><option value="12">Dec</option> </select></div></div><div class="col-md-2 mb-3 pricing"> <div class="col-xs-1"> <select class="form-control required peakend" name="price[' + pricecountnew + '][peakend]" id="peakend_' + pricecountnew + '"><option value="">To</option><option value="1">Jan</option><option value="2">Feb</option><option value="3">Mar</option><option value="4">Apr</option><option value="5">May</option><option value="6">Jun</option><option value="7">Jul</option><option value="8">Aug</option><option value="9">Sep</option><option value="10">Oct</option><option value="11">Nov</option><option value="12">Dec</option> </select></div></div><div class="col-md-2 mb-3 pricing"> <div class="input-group col-xs-1"><div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1">RM</span></div> <input type="text" class="form-control required" name="price[' + pricecountnew + '][normalprice]" id="normalprice_' + pricecountnew + '"></div></div><div class="col-md-2 mb-3 pricing"> <div class="input-group col-xs-1"><div class="input-group-prepend"> <span class="input-group-text" id="basic-addon1">RM</span></div> <input type="text" class="form-control required" name="price[' + pricecountnew + '][peakprice]" id="peakprice_' + pricecountnew + '"></div></div><div class="col-md-2 pricing"><input type="button" value="X" class="btn btn-danger removepricing"></div></div>';
        $(".mainprice").append(element);
        $("#billing_type_" + pricecountnew).select2();
    }
    //$("#mainitem").clone().attr('id','').appendTo(".nearbyattraction").find("input:text").val("");
})
$("input[name='capacity_by']").click(function() {
    var capacityby = $("input[name='capacity_by']:checked").val();
    if (capacityby == '1') {
        $(".byarea").css('display', '');
        $(".bydimension").css('display', 'none');
        $(".bydimension").find('input').val('');
    }
    if (capacityby == '2') {
        $(".byarea").css('display', 'none');
        $(".bydimension").css('display', 'flex');
        $(".byarea").find('input').val('');
    }
});
$("#root_category").on('change', function() {
    $.ajax({
        url: "/getparentcategory",
        type: "post",
        data: {
            id: $(this).val(),
            "_token": $('#csrf-token')[0].content
        },
        dataType: "json",
        success: function(datas) {
            $('#parent_category').find('option').remove()
            $("#parent_category").append('<option>Select</option>');
            $.each(datas, function(data, category) {
                //  console.log(data)
                $("#parent_category").append('<option value="' + category.id + '">' + category.name + '</option>');
            });
        }
    })
})
$("#parent_category").on('change', function() {
    $.ajax({
        url: "/getchildcategory",
        type: "post",
        data: {
            id: $(this).val(),
            "_token": $('#csrf-token')[0].content
        },
        dataType: "json",
        success: function(datas) {
            $('#child_category').find('option').remove()
            $("#child_category").append('<option>Select</option>');
            $.each(datas, function(data, category) {
                $("#child_category").append('<option value="' + category.id + '">' + category.name + '</option>');
            });
        }
    })
})
$("#child_category").on('change', function() {
    $.ajax({
        url: "/getnichecategory",
        type: "post",
        data: {
            id: $(this).val(),
            "_token": $('#csrf-token')[0].content
        },
        dataType: "json",
        success: function(datas) {
            $('#niche_category').find('option').remove()
            $("#niche_category").append('<option>Select</option>');
            $.each(datas, function(data, category) {
                $("#niche_category").append('<option value="' + category.id + '">' + category.name + '</option>');
            });
        }
    })
})
$("#country").on('change', function() {
    $.ajax({
        url: "/getstates",
        type: "post",
        data: {
            id: $(this).val(),
            "_token": $('#csrf-token')[0].content
        },
        dataType: "json",
        success: function(datas) {
            $('#state').find('option').remove()
            $("#state").append('<option>Select</option>');
            $.each(datas, function(data, state) {
                $("#state").append('<option value="' + state.regionId + '">' + state.name + '</option>');
            });
        }
    })
});
$("#state").on('change', function() {
    $.ajax({
        url: "/getcities",
        type: "post",
        data: {
            id: $(this).val(),
            "_token": $('#csrf-token')[0].content
        },
        dataType: "json",
        success: function(datas) {
            $('#city').find('option').remove()
            $("#city").append('<option>Select</option>');
            $.each(datas, function(data, state) {
                $("#city").append('<option value="' + state.cityId + '">' + state.name + '</option>');
            });
        }
    })
});
$("#uploadFile").change(function() {
    $('#image_preview').html("");
    var total_file = document.getElementById("uploadFile").files.length;
    for (var i = 0; i < total_file; i++) {
        $('#image_preview').append("<img src='" + URL.createObjectURL(event.target.files[i]) + "' height='160px' width='160px' style='margin:10px;'>");
    }
});
$(document).on('click', '.removenearby', function() {
    $(this).parent('div').parent('div').remove();
})
$(document).on('click', '.removepricing', function() {
    $(this).parent('div').parent('div').remove();
    var newcount = parseInt($("#pricecountnew").val()) - 1;
    $("#pricecountnew").val(newcount)
})
$("body").on('change', '.peakstart', function() {
    console.log($(this).val())
    $(".peakstart").val($(this).val())
})
$("body").on('change', '.peakend', function() {
    $(".peakend").val($(this).val())
})

function showAdditionalAmount(e) {
    var id = $(e).attr('id');
    if ($(e).val() == "2") {
        $(".amount_" + id).css('display', 'flex');
    } else {
        $(".amount_" + id).css('display', 'none');
    }
    if ((id == '5' || id == "6") && ($("#5").val() == '1' || $("#5").val() == '2' || $("#6").val() == '1' || $("#6").val() == '2')) {
        $(".byledlcd").css("display", "flex");
    } else {
        $(".byledlcd").css("display", "none");
        $("#screen_size,#panel_size").val('');
    }
}
