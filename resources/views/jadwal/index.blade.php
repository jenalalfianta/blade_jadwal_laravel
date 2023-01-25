<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jadwal Pemakaian Ruang') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Modal toggle -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    @include('jadwal.layout.modal')

{{--
    var calendar = $('#calendar').fullCalendar({
        events: @json($datas),
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        selectable:true,
        selectHelper:true,
        select: function(start, end, allDays){
            $('#openModal').click()
            $('#title').val('')

            $('#saveDate').click(function(){
                event.preventDefault();

                var title = $('#title').val();
                var start_date = moment(start).format('Y-M-D h:mm:ss');
                var end_date = moment(end).format('Y-M-D h:mm:ss');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{route('jadwal.store')}}",
                    dataType: "json",
                    data: {title, start_date, end_date},
                    success: function(response){
                        $('#titleError').html('')
                        $('#title').html('')
                        $('#closeModal').click()
                        $('#calendar').fullCalendar('renderEvent', {
                            'title': response.title,
                            'start': response.start,
                            'finish': response.finish,
                        })
                    },
                    error: function(error){
                        $('#titleError').html(error.responseJSON.errors.title)

                    },
                })

            })
        },
        // selectOverlap: true,
        // editable:true,
        locale: 'id',
        height: 'auto',
        minTime: '07:00:00',
        maxTime: '17:00:00',
        axisFormat: 'HH:mm',
        timeFormat: 'HH:mm',
        slotLabelFormat: 'HH:mm',
        titleFormat: 'MMMM D , YYYY',
        columnHeaderFormat: 'ddd-D',
        // slotDuration: '1:00',
        allDaySlot: false,
        // windowResizeDelay: 0,
        // eventLongPressDelay: 0,
        // longPressDelay: 0,
        displayEventEnd: true,
    }) --}}

    @push('scripts')
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/locale-all.js"></script> --}}

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.0.3/main.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.0.3/index.global.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>



        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                events: @json($datas),
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'hari ini',
                    month: 'bulan',
                    week: 'minggu',
                    day: 'hari',
                    list: 'daftar'
                },
                locale: 'id',
                windowResizeDelay: 0,
                height: 'auto',
                slotMinTime: "07:00:00",
                slotMaxTime: "17:00:00",
                allDaySlot: false,
                slotLabelFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    omitZeroMinute: false,
                    meridiem: 'false'
                },
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    omitZeroMinute: false,
                    meridiem: 'false'
                },
                displayEventTime: true,
                displayEventEnd: true,
                eventDisplay: 'block',
                editable: true,
                selectable: true,
                eventLimit: true,
                select: function(select) {
                    $('#openModal').click()
                    $('#title').val('')

                    $('#saveDate').click(function(){
                        event.preventDefault();

                        var title = $('#title').val();
                        var start_date = moment(select.start).format('Y-M-D h:mm:ss');
                        var end_date = moment(select.end).format('Y-M-D h:mm:ss');

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "POST",
                            url: "{{route('jadwal.store')}}",
                            dataType: "json",
                            data: {title, start_date, end_date},
                            success: function(response){
                                calendar.addEvent({
                                    title: response.title,
                                    start: response.start,
                                    finish: response.finish,
                                    allDay: true
                                });
                            },
                            error: function(error){
                                $('#titleError').html(error.responseJSON.errors.title)

                            },
                        })

                    })
                },
            })

            calendar.render()

        })



        </script>
    @endpush
</x-app-layout>
