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

    @push('scripts')

        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.0.3/index.global.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

        <script>
            var calendar;

            $( document ).ready(function() {

                var calendarEl = $('#calendar')[0];
                    calendar = new FullCalendar.Calendar(calendarEl, {
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
                    unselectAuto: true,
                    select: function(response) {
                        console.log(response)
                        $('#openModal').click()
                        $('#title').val('')

                        $('#saveDate').click(function(){
                            event.preventDefault();

                            var title = $('#title').val();
                            var start_date = moment(response.start).format('Y-M-D h:mm:ss');
                            var end_date = $('#title').val();

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: "POST",
                                url: "{{route('jadwal.store')}}",
                                dataType: "json",
                                data: {title, start_date, end_date},
                                success: function(response){
                                    $('#closeModal').click()
                                    $('#title').val('')
                                    // calendar.removeAllEvents()
                                    addNewEvent(response)

                                },
                                error: function(error){
                                    $('#titleError').html(error.responseJSON.errors.title)

                                },
                            })

                        })
                    },
                })

                function addNewEvent(response){
                    console.log(response)
                    calendar.addEvent({
                        title: response.title,
                        start: response.start,
                        end: response.end,
                        allDay: true,
                    });
                }

                calendar.render();

                $("#startDate").flatpickr(
                    {
                        altInput: true,
                        altFormat: "F j, Y",
                        dateFormat: "Y-m-d",
                        locale: 'id',
                    }
                )
                $("#startTime").flatpickr(
                    {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        locale: 'id',
                    }
                )

                $("#endTime").flatpickr(
                    {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        locale: 'id',
                    }
                );
            })


        </script>
    @endpush
</x-app-layout>
