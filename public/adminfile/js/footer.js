var form=$("#addlistingwizard").show();
form.steps({
    headerTag:"h3",
    bodyTag: "fieldset",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {
            return true;
        }
        // Forbid next action on "Warning" step if the user is to young

        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex)
        {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled,:hidden:not(textarea)";
        for (i=0; i < tinymce.editors.length; i++){
            var content = tinymce.editors[i].getContent(); // get the content
            console.log($('#'+tinymce.editors[i].id))
            $('#'+tinymce.editors[i].id).val(content); // put it in the textarea
        }
        return form.valid();
    },
    onStepChanged: function (event, currentIndex, priorIndex)
    {
        // Used to skip the "Warning" step if the user is old enough.

        // Used to skip the "Warning" step if the user is old enough and wants to the previous step.

    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled,:hidden:not(textarea)";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        $('#addlistingwizard').ajaxSubmit({
            "url":"savelisting",
            "type":"post",
            "dataType":"json",
            "success":function(response){
                if(response.status=="success"){
                    window.location.href="/admin/managelisting";
                }else{
                    $("#message").css("display","");
                    $("#message").html(response.message);
                }
            }
        })
    }
}).validate({
    errorPlacement: function errorPlacement(error, element) {
        //element.insertAfter(error);
        if(element.type=="textarea"){
            error.appendTo(element.next());
        }else{
            error.appendTo(element.parent('div'))
        }

    },

})


var form1=$("#editlistingwizard").show();
form1.steps({
    headerTag:"h3",
    bodyTag: "fieldset",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {
            return true;
        }
        // Forbid next action on "Warning" step if the user is to young

        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex)
        {
            // To remove error styles
            form1.find(".body:eq(" + newIndex + ") label.error").remove();
            form1.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form1.validate().settings.ignore = ":disabled,:hidden:not(textarea)";
        for (i=0; i < tinymce.editors.length; i++){
            var content = tinymce.editors[i].getContent(); // get the content
            console.log($('#'+tinymce.editors[i].id))
            $('#'+tinymce.editors[i].id).val(content); // put it in the textarea
        }
        return form1.valid();
    },
    onStepChanged: function (event, currentIndex, priorIndex)
    {
        // Used to skip the "Warning" step if the user is old enough.

        // Used to skip the "Warning" step if the user is old enough and wants to the previous step.

    },
    onFinishing: function (event, currentIndex)
    {
        form1.validate().settings.ignore = ":disabled,:hidden:not(textarea)";
        return form1.valid();
    },
    onFinished: function (event, currentIndex)
    {
        $('#editlistingwizard').ajaxSubmit({
            "url":"updatelisting",
            "type":"post",
            "dataType":"json",
            "success":function(response){
                if(response.status=="success"){
                    window.location.href="/admin/managelisting";
                }else{
                    $("#message").css("display","");
                    $("#message").html(response.message);
                }
            }
        })
    }
}).validate({
    errorPlacement: function errorPlacement(error, element) {
        //element.insertAfter(error);
        if(element.type=="textarea"){
            error.appendTo(element.next());
        }else{
            error.appendTo(element.parent('div'))
        }

    },

})

$(".addnearby").click(function () {
    var itemcount=$("#itemcountnew").val();
    var itemcountnewadd=parseInt(itemcount)+1;
    $("#itemcountnew").val(itemcountnewadd);
    var itemcountnew=$("#itemcountnew").val();
    var element='<div class="col-md-12 mainitem"><div class="col-md-5 nearby"><input type="text" name="nearby['+itemcountnew+'][location]" class="form-control" placeholder="location"><input type="hidden" name="nearby['+itemcountnew+'][nearbyid]" class="form-control" value="0"></div><div class="col-md-5 nearby"><input type="text" name="nearby['+itemcountnew+'][distance]" class="form-control" placeholder="distance in KM"></div><div class="col-md-1 nearby"><input type="button" value="X" class="btn btn-danger removenearby"></div><br><br></div>'
    $(".nearbyattraction").append(element);
    //$("#mainitem").clone().attr('id','').appendTo(".nearbyattraction").find("input:text").val("");
})

$("input[name='capacity_by']").click(function(){
    var capacityby=$("input[name='capacity_by']:checked").val();
    if(capacityby=='1'){
        $(".byarea").css('display','');
        $(".bydimension").css('display','none');
        $(".bydimension").find('input').val('');
    }

    if(capacityby=='2'){
        $(".byarea").css('display','none');
        $(".bydimension").css('display','flex');
        $(".byarea").find('input').val('');
    }


});
