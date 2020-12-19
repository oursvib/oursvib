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

