$("#managelisting").DataTable({
    "responsive": true,
    "autoWidth": false,
});

$("#addlistingwizard").steps({
    headerTag:"h1",
    bodyTag: "div",
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        // Allways allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {
            return true;
        }
        // Forbid next action on "Warning" step if the user is to young
        if (newIndex === 3 && Number($("#age-2").val()) < 18)
        {
            return false;
        }
        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex)
        {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
        }
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onStepChanged: function (event, currentIndex, priorIndex)
    {
        // Used to skip the "Warning" step if the user is old enough.
        if (currentIndex === 2 && Number($("#age-2").val()) >= 18)
        {
            form.steps("next");
        }
        // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
        if (currentIndex === 2 && priorIndex === 3)
        {
            form.steps("previous");
        }
    },
    onFinishing: function (event, currentIndex)
    {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {
        alert("Submitted!");
    }
}).validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password-2"
        }
    }
});

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

            $("#parent_category").append('<option>Select</option>');
            $.each(datas,function(data,category){
                console.log(data)
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

            $("#niche_category").append('<option>Select</option>');
            $.each(datas,function(data,category){
                $("#niche_category").append('<option value="'+category.id+'">'+category.name+'</option>');
            });
        }
    })
})
