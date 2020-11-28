$("#managelisting").DataTable({
    "responsive": true,
    "autoWidth": false,
});
tinymce.init({
    selector:"#description,#team,#aboutus"
});

// $("#addlistingwizard").steps({
//     headerTag:"h3",
//     bodyTag: "fieldset",
//     onFinished: function (event, currentIndex)
//     {
//         $('#addlistingwizard').ajaxSubmit({url:"savelisting",type:"post"})
//     }
// });
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

$(document).ready(function() {
    $(".select2").select2();
});
$("#root_category").on('change',function(){
    $.ajax({
        url:"/getparentcategory",
        type:"post",
        data:{
            id:$(this).val(),
            "_token": $('#csrf-token')[0].content
        },
        dataType:"json",
        success:function(datas){
            $('#parent_category')
                .find('option')
                .remove()
            $("#parent_category").append('<option>Select</option>');
            $.each(datas,function(data,category){
              //  console.log(data)
                $("#parent_category").append('<option value="'+category.id+'">'+category.name+'</option>');
            });
        }
    })
})

$("#parent_category").on('change',function(){
    $.ajax({
        url:"/getchildcategory",
        type:"post",
        data:{
            id:$(this).val(),
            "_token": $('#csrf-token')[0].content
        },
        dataType:"json",
        success:function(datas){
            $('#child_category')
                .find('option')
                .remove()
            $("#child_category").append('<option>Select</option>');
            $.each(datas,function(data,category){
                $("#child_category").append('<option value="'+category.id+'">'+category.name+'</option>');
            });
        }
    })
})

$("#child_category").on('change',function(){
    $.ajax({
        url:"/getnichecategory",
        type:"post",
        data:{
            id:$(this).val(),
            "_token": $('#csrf-token')[0].content
        },
        dataType:"json",
        success:function(datas){
            $('#niche_category')
                .find('option')
                .remove()
            $("#niche_category").append('<option>Select</option>');
            $.each(datas,function(data,category){
                $("#niche_category").append('<option value="'+category.id+'">'+category.name+'</option>');
            });
        }
    })
})

$(".addnearby").click(function () {
    var itemcount=$("#itemcountnew").val();
    var itemcountnewadd=parseInt(itemcount)+1;
    $("#itemcountnew").val(itemcountnewadd);
    var itemcountnew=$("#itemcountnew").val();
    var element='<div class="col-md-12 mainitem"><div class="col-md-5 nearby"><input type="text" name="nearby['+itemcountnew+'][location]" class="form-control" placeholder="location"></div><div class="col-md-5 nearby"><input type="text" name="nearby['+itemcountnew+'][distance]" class="form-control" placeholder="distance in KM"></div><div class="col-md-1 nearby"><input type="button" value="X" class="btn btn-danger removenearby"></div><br><br></div>'
    $(".nearbyattraction").append(element);
    //$("#mainitem").clone().attr('id','').appendTo(".nearbyattraction").find("input:text").val("");
})
$(document).on('click','.removenearby',function(){
    $(this).parent('div').parent('div').remove();
})
$("#country").on('change',function(){
    $.ajax({
        url:"/getstates",
        type:"post",
        data:{
            id:$(this).val(),
            "_token": $('#csrf-token')[0].content
        },
        dataType:"json",
        success:function(datas){
            $('#state')
                .find('option')
                .remove()
            $("#state").append('<option>Select</option>');
            $.each(datas,function(data,state){
                $("#state").append('<option value="'+state.regionId+'">'+state.name+'</option>');
            });
        }
    })
});

$("#state").on('change',function(){
    $.ajax({
        url:"/getcities",
        type:"post",
        data:{
            id:$(this).val(),
            "_token": $('#csrf-token')[0].content
        },
        dataType:"json",
        success:function(datas){
            $('#city')
                .find('option')
                .remove()
            $("#city").append('<option>Select</option>');
            $.each(datas,function(data,state){
                $("#city").append('<option value="'+state.regionId+'">'+state.name+'</option>');
            });
        }
    })
})

$("#uploadFile").change(function(){

    $('#image_preview').html("");

    var total_file=document.getElementById("uploadFile").files.length;

    for(var i=0;i<total_file;i++)

    {

        $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"' height='160px' width='160px' style='margin:10px;'>");

    }

});

function deleteListing(id){

    if(confirm("Are you sure to want to delete this listing?")){
        $.ajax({
            "url":"deletelisting",
            "dataType":"json",
            "data":{
                "listingid":id,
                "_token": $('#csrf-token')[0].content
            },
            "type":"post",
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
}

