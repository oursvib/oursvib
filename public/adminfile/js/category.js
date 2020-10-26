$("#managecategory").DataTable({
    "responsive": true,
    "autoWidth": false,
});


$('.addcategory').on('click', function(){
    var this_action = $(this).attr('data-action');
    var this_url = $(this).attr('data-url');
    if(this_action == 'add'){

        $.get(this_url, function( data ) {
            $('#addcategorymodel').modal();
            $('#addcategorymodel').on('shown.bs.modal', function(){
                $('#addcategorymodel .load_modal_view').html(data);
            });
            $('#addparentcategory').on('hidden.bs.modal', function(){
                $('#addparentcategory .modal-body').data('');
            });
        });
    }
});

