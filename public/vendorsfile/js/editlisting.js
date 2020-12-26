tinymce.init({
    selector:"#description,#team,#aboutus"
});

function showParentCategory(rootcategory,parentcategory){

        $.ajax({
            url:"/getparentcategory",
            type:"post",
            data:{
                id:rootcategory,
                "_token": $('#csrf-token')[0].content
            },
            dataType:"json",
            success:function(datas){
                $('#parent_category')
                    .find('option')
                    .remove()
                $("#parent_category").append('<option>Select</option>');
                $.each(datas,function(data,category){
                    if(category.id==parentcategory){
                        selectedb="selected"
                    }else{
                        selectedb="";
                    }
                    $("#parent_category").append('<option value="'+category.id+'"   '+selectedb+' >'+category.name+'</option>');
                });
            }
        })

}


function showChildCategory(parentcategory,childcategory){
    $.ajax({
        url:"/getchildcategory",
        type:"post",
        data:{
            id:parentcategory,
            "_token": $('#csrf-token')[0].content
        },
        dataType:"json",
        success:function(datas){
            $('#child_category')
                .find('option')
                .remove()
            $("#child_category").append('<option>Select</option>');
            $.each(datas,function(data,category){
                if(category.id==childcategory){
                    selectedb="selected"
                }else{
                    selectedb="";
                }
                $("#child_category").append('<option value="'+category.id+'" '+selectedb+'>'+category.name+'</option>');
            });
        }
    })
}

function showNicheCategory(childcategory,nichecategory){
    $.ajax({
        url:"/getnichecategory",
        type:"post",
        data:{
            id:childcategory,
            "_token": $('#csrf-token')[0].content
        },
        dataType:"json",
        success:function(datas){
            $('#niche_category')
                .find('option')
                .remove()
            $("#niche_category").append('<option>Select</option>');
            $.each(datas,function(data,category){
                if(category.id==nichecategory){
                    selectedb="selected"
                }else{
                    selectedb="";
                }
                $("#niche_category").append('<option value="'+category.id+'" '+selectedb+'>'+category.name+'</option>');
            });
        }
    })
}

function showState(countryid,stateid){
    $.ajax({
        url:"/getstates",
        type:"post",
        data:{
            id:countryid,
            "_token": $('#csrf-token')[0].content
        },
        dataType:"json",
        success:function(datas){
            $('#state')
                .find('option')
                .remove()
            $("#state").append('<option>Select</option>');
            $.each(datas,function(data,state){
                if(state.regionId==stateid){
                    selectedb="selected"
                }else{
                    selectedb="";
                }
                $("#state").append('<option value="'+state.regionId+'" '+selectedb+'>'+state.name+'</option>');
            });
        }
    })
}

function showCity(stateid,cityid){
    $.ajax({
        url:"/getcities",
        type:"post",
        data:{
            id:stateid,
            "_token": $('#csrf-token')[0].content
        },
        dataType:"json",
        success:function(datas){
            $('#city')
                .find('option')
                .remove()
            $("#city").append('<option>Select</option>');
            $.each(datas,function(data,state){
                if(state.cityId==cityid){
                    selectedb="selected"
                }else{
                    selectedb="";
                }
                $("#city").append('<option value="'+state.cityId+'" '+selectedb+'>'+state.name+'</option>');
            });
        }
    })
}

function capacityby(capacityby){

    if(capacityby=='1'){
        $(".byarea").css('display','');
        $(".bydimension").css('display','none');
       // $(".bydimension").find('input').val('');
    }

    if(capacityby=='2'){
        $(".byarea").css('display','none');
        $(".bydimension").css('display','flex');
        //$(".byarea").find('input').val('');
    }
}

