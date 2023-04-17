<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
         @push('topscripts')
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css" rel="stylesheet"/>
         @endpush()
                <div class="container">
                    <div class="panel panel-primary">
                        <div class="panel-heading">   
                           Manage Calendar with Laravel 
                        </div>
                        <div class="panel-body" >
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
                </body>
                @push('scripts')
                <script>
                    $(document).ready(function () {
                        var calendar = $('#calendar').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,basicWeek,basicDay'
                            },
                            navLinks: true,
                            editable: true,
                            events: "getevent",           
                            displayEventTime: false,
                            eventRender: function (event, element, view) {
                                if (event.allDay === 'true') {
                                    event.allDay = true;
                                } else {
                                    event.allDay = false;
                                }
                            },
                        selectable: true,
                        selectHelper: true,
                        select: function (start, end, allDay) {
                            var title = prompt('Event Title:');
                            if (title) {
                                var start = moment(start, 'DD.MM.YYYY').format('YYYY-MM-DD');
                                var end = moment(end, 'DD.MM.YYYY').format('YYYY-MM-DD');
                                $.ajax({
                                    url: "{{route('creatent')}}",
                                    data: 'title=' + title + '&start=' + start + '&end=' + end +'&_token=' +"{{ csrf_token() }}",
                                    type: "post",
                                    success: function (data) {
                                        alert("Added Successfully");
                               
                                            window.location.reload();
                                       
                                    }
                                });
                                calendar.fullCalendar('renderEvent',
                                        {
                                            title: title,
                                            start: start,
                                            end: end,
                                            allDay: allDay
                                        },
                                            true
                                        );
                            }
                            calendar.fullCalendar('unselect');
                        },
                        eventClick: function (event) {
                            var deleteMsg = confirm("Do you really want to delete?");
                            console.log(event.id);
                            if (deleteMsg) {
                                $.ajax({
                                    type: "POST",
                                    url: "{{route('delevent')}}",
                                    data: "&id=" + event.id+'&_token=' +"{{ csrf_token() }}",
                                    success: function (response) {
                                        if(parseInt(response) > 0) {
                                            $('#calendar').fullCalendar('removeEvents', event.id);
                                            alert("Deleted Successfully");
                                        }
                                    }
                                });
                            }
                          }
                        });
                    });
                </script>
           
           @endpush()
            </div>
        </div>
    </div>
    
</x-app-layout>
