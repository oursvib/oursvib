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

$("#role").change(function(){
    if($(this).val()=='4'){
        $("#company_name_div").hide();
    }else{
        $("#company_name_div").show();
    }
})
$("#register-form").validate({
    rules: {
        role: {
            required: true
        },
        name: {
            required: true
        },
        email: {
            required: true,
            email: true,
            remote: {
                url: "/validate_email",
                type: "post",
                data: {
                    _token:  $('meta[name="_token"]').attr('content')
                },

            }
        },
        passwordr: {
            required: true
        },
        password_confirmation: {
            required: true,
            equalTo: '#passwordr'
        },
        company_name: {
            required: true
        },
        phone_number: {
            required: true
        }
    },
    messages:{
        email:{
            remote:"This email already exists"
        }
    },
    submitHandler: function (form) {
        //event.preventDefault();
       form.submit();
        // $.ajax({
        //     url: "register",
        //     type: "POST",
        //     data: $("#register-form").serialize(),
        //     dataType: "json",
        //     success: function (data) {
        //         if (data.status == "success") {
        //             window.location.href = data.redirectto
        //         }
        //     },
        //     error: function (data) {
        //         $("#errors").html(data.responseJSON.errors.email)
        //     }
        // })
    }
});

$("#countrylist").on('change',function(){
    var countryid=$(this).val();
    $.ajax({
        "url":"setcountry",
        "data":{countryid:countryid, _token:  $('meta[name="_token"]').attr('content')},
        "type":"POST",
        "dataType":"json",
        "success":function(data){
            if(data.status=="success"){
                window.location.reload();
            }else{
                window.location.reload();
            }
        }
    })
});

$("#states").on('change', function() {
    $.ajax({
        url: "/getcities",
        type: "post",
        data: {
            id: $(this).val(),
            "_token": $('meta[name="_token"]').attr('content')
        },
        dataType: "json",
        success: function(datas) {
            $('#city').find('option').remove();
             var htmldata='<select name="city" id="city" data-placeholder="Any Status" >';
            htmldata +='<option>Select</option>';
            $.each(datas, function(data, state) {
               htmldata+='<option value="' + state.cityId + '">' + ucfirst(state.name) + '</option>';
            });

            $("#citylistdiv").html(htmldata);
            $("#city").chosen({disable_search_threshold: 100,
                width: "100%"});
        }
    });
});
$("input[type='number']").inputSpinner()
$('input[name="bookingframe"]').daterangepicker();
$("#searchform").validate({
    ignore: ":hidden:not(select)",
    rules: {
        listingtype: {
            required: true
        },
        bookingframe: {
            required: true
        },
        states: {
            required: true,
        },
        city: {
            required: true,
        },
        paxrange: {
            required: true,
        }
    },
    errorPlacement: function errorPlacement(error, element) {
        //element.insertAfter(error);
         error.appendTo(element.next());

    },
    submitHandler: function (form) {
        //event.preventDefault();
        form.submit();

    }
});
function doAjaxSearch(){
    $.ajax({
        url: "/searchlisting",
        type: "post",
        data:$("#searchform").serialize(),
        dataType: "json",
        success: function(response) {
            console.log(response)
            if(response.total>1){
                listinghtml='';
                $.each(response.data,function(i,listing){
                    listinghtml +='<div class="utf-listing-item"> <a href="#" class="utf-smt-listing-img-container" > <div class="utf-listing-img-content-item"> <img class="utf-user-picture d-none" src="https://oursvib.s3.amazonaws.com/medium_image/medium_'+listing.listingimages[0].listing_images+'" alt="user_1" > </div><img src="https://oursvib.s3.amazonaws.com/medium_image/medium_'+listing.listingimages[0].listing_images+'" alt="" > </a> <div class="utf-listing-content"> <div class="utf-listing-title"> <span class="utf-listing-price">Starts from RM '+listing.listingprice[0].normal_price+'</span> <h4><a href="#">'+listing.title+'</a></h4> <span class="utf-listing-address"><i class="icon-material-outline-location-on"></i>'+ucfirst(listing.listingcity.name)+','+ucfirst(listing.listingstate.name)+','+ucfirst(listing.listingcountry.name)+'</span> </div><div class="utf-listing-user-info d-none"><a href="#"><i class="icon-line-awesome-user"></i> John Williams</a> <span>1 Days Ago</span></div></div></div>'
                })

                var pagelinks='';
                $.each(response.links,function(j,pages) {

                        pagelinks += '  <li><a href="'+pages.url+'">'+pages.label+'</a></li>';

                });
                $("#searchresult").html(listinghtml)
                $("#pagelinks").html(pagelinks)
            }else{

            }

        }
    })
}
$("#bookingfrom").datetimepicker({
    startDate:new Date(),
    autoClose:true,
    minuteStep:10
}).on('changeDate',function (selected) {
    var minDate = new Date(selected.date.valueOf());
    var startdate= moment(minDate).format( "YYYY-MM-DD");
    $('#bookingto').datetimepicker({'startDate':startdate,'todayHighlight':false});
})

$("#checkavailability").on('click',function () {
    var startdate=$("#bookingfrom").val();
    var enddate=$("#bookingto").val();
    var listingid=$("#listing").val();
    $.ajax({
        url: "/checkavailability",
        type: "post",
        data:$("#checkavailabilityform").serialize(),
        dataType: "json",
        success:function(data){
            if(data.status=="failure"){
                $("#proceedbooking").hide();
                $("#messagecenter").addClass('alert alert-danger')
                $("#messagecenter").text(data.message)
            }
            if(data.status=="success"){
                $("#messagecenter").removeClass('alert alert-danger')
                $("#messagecenter").addClass('alert alert-success')
                $("#messagecenter").text(data.message);
                $("#proceedbooking").show();
            }

        }
    })
});
