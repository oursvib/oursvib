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
                $("#city").append('<option value="'+state.cityId+'">'+state.name+'</option>');
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



function showAdditionalAmount(e){
var id=$(e).attr('id');
if($(e).val()=="2") {
    $(".amount_" + id).css('display', 'flex');
}else{
    $(".amount_"+id).css('display','none');
}
}

