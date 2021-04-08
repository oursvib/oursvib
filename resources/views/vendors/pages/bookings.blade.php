
@extends('vendors.layouts.default')
@section('content')
    <div class="content p-4">
        <h2 class="mb-4">Booking Calendar</h2>
        <div class="mb-4">
            <a href="#" class="btn btn-primary addbooking"   data-action="add" data-url="/vendors/addbooking" data-toggle="modal" data-target="#editevent">Block dates</a>
        </div>


        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="card mb-4">
            <div class="card-body">
               <div id="calendar"></div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="editevent">
        <div class="modal-dialog">
            <div class="modal-content load_modal_view">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="updateevent">
        <div class="modal-dialog">
            <div class="modal-content load_modal_view">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialDate: new Date(),
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: true,
                // select: function(arg) {
                //     var title = prompt('Event Title:');
                //     if (title) {
                //         calendar.addEvent({
                //             title: title,
                //             start: arg.start,
                //             end: arg.end,
                //             allDay: arg.allDay
                //         })
                //     }
                //     calendar.unselect()
                // },
                eventClick: function(arg) {
                   /* if (confirm('Are you sure you want to delete this event?')) {
                        arg.event.remove()
                    }*/
                    arg.jsEvent.preventDefault();
                    $.ajax({
                    	url:"viewbooking",
                    	data:{bookingid:arg.event._def.publicId,bookingrefno:arg.event._def.extendedProps.bookingrefno, "_token": $('#csrf-token')[0].content},
                    	dataType: "html",
                    	type: "POST",
                    	success:function(data){

            						 $('#editevent').on('shown.bs.modal', function() {
               					 		$('#editevent .load_modal_view').html(data);
            						 });
                                    $('#editevent').modal('show');
                    	}
                    })


                },
                             editable: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events:{!! $bookingjson !!}
            });

            calendar.render();
        });

$('.addbooking').on('click', function () {
    var this_action = $(this).attr('data-action');
    var this_url = $(this).attr('data-url');


    if (this_action == 'add') {

        $.get(this_url, function (data) {

             $('#editevent').on('hidden.bs.modal', function () {
                $('#editevent .modal-body').html('');
            });
            $('#editevent').on('shown.bs.modal', function () {
                $('#editevent .load_modal_view').html(data);
            });
            $('#editevent').modal();

        });
    }
});
    </script>
@stop
