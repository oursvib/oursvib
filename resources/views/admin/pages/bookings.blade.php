
@extends('admin.layouts.default')
@section('content')
    <div class="content p-4">
        <h2 class="mb-4">Booking Calendar</h2>
        <div class="mb-4">
            <a href="#" class="btn btn-primary manageuser"   data-action="add" data-url="/admin/adduser" data-toggle="modal" data-target="#manageusermodal">Add booking</a>
        </div>



        <div class="card mb-4">
            <div class="card-body">
               <div id="calendar"></div>

            </div>
        </div>
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
                select: function(arg) {
                    var title = prompt('Event Title:');
                    if (title) {
                        calendar.addEvent({
                            title: title,
                            start: arg.start,
                            end: arg.end,
                            allDay: arg.allDay
                        })
                    }
                    calendar.unselect()
                },
                eventClick: function(arg) {
                    if (confirm('Are you sure you want to delete this event?')) {
                        arg.event.remove()
                    }
                },
                editable: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events:{!! $bookingjson !!}
            });

            calendar.render();
        });

    </script>
@stop
