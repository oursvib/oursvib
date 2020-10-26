<form action="javascript:void(0)" method="post" id="addnichecategory">
    <div class="modal-header">
    <h4 class="modal-title">Add Niche category</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">

    @csrf
    <div class="row">
                        <div class="col-md-12">
                           <div class="alert alert-success d-none" id="msg_div">
                                   <span id="res_message"></span>
                              </div>
                        </div>
                     </div>

    <p>child category:</p>
    <?php // echo '<pre>';
    //print_r(json_encode($rootcategory));exit;?>
{{$rootcategory}}
    <?php exit;?>
    <select class="form-control" name="parent_id" id="parent_id">
            <option value="">Select</option>
            @foreach($rootcategory as $root)
                <optgroup label="{{$root->name}}">
                @if($root->subcategory)
                    @include('admin.pages.childcategoryselect',['subcategories' => $root->subcategory])
                @endif
            @endforeach
                </optgroup>
        </select>
        <p>Niche category name:</p>
    <p>
        <input type="text" name="name" id="name" class="form-control"  placeholder="Niche category name">
    </p>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <input type="submit" class="btn btn-primary" value="Save changes">
</div>
</form>
<script>
    $("#addchildcategory").validate({
        rules: {
            parent_id: {
                required: true,
            },
            name: {
                required: true,
                maxlength: 100,
            },
        },
        messages: {

            parent_id: {
                required: "Please select parent category",
            },
            name: {
                required: "Please enter child category name",
                minlength: "Parent category name should not exceed 100 character",
            },
        },
        submitHandler: function(form) {
            $.ajax({
                url: "{{ url('/admin/savechildcategory')}}" ,
                type: "POST",
                data: $('#addchildcategory').serialize(),
                success: function( response ) {
                    $('#send_form').html('Submit');
                    $('#res_message').show();
                    $('#res_message').html(response.msg);
                    $('#msg_div').removeClass('d-none');

                    $("#addchildcategory")[0].reset();
                    setTimeout(function(){
                        $('#res_message').hide();
                        $('#msg_div').hide();
                        $("#addcategorymodel").modal('hide');
                    },5000);
                }
            });
        }
    })
</script>
