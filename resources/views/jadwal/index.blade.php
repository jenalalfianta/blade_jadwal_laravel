<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jadwal Pemakaian Ruang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    @include('jadwal.layout.modal')

    @push('scripts')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.0.3/index.global.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>
        <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
        <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            let datas = @json($datas);
            let calendar;
            let calendar_picker;
            let hours = moment().format('HH:mm');

            $( document ).ready(function() {
    // modal jadwal show or hide
                const $targetEl = document.getElementById('modalAdd');
                const options = {
                    backdrop: 'static',
                    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
                    closable: false,
                };

                const modalAdd = new Modal($targetEl, options);

                @if (count($errors) > 0)
                    modalAdd.show();
                @endif

                $('#closeModal').click(function(){
                    modalAdd.hide();
                });

    //fullcalendar js
                let calendarEl = $('#calendar')[0];
                    calendar = new FullCalendar.Calendar(calendarEl, {
                    events: datas,
                    initialView: 'dayGridMonth',
                    themeSystem: 'bootstrap5',
                    headerToolbar: {
                        left: 'prev,today,next tambahButton',
                        center: 'title',
                        right: 'listMonth dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    // views: {
                    //     listDay: { buttonText: 'list day' },
                    //     listWeek: { buttonText: 'list week' },
                    //     listMonth: { buttonText: 'list month' }
                    // },
                    buttonText: {
                        today: 'hari ini',
                        month: 'bulan',
                        week: 'minggu',
                        day: 'hari',
                        listMonth: 'seluruh jadwal'
                    },
                    customButtons: {
                        tambahButton: {
                            text: '+ Tambah Jadwal',
                            click: function() {
                                $('#ruang').val('Pilih Ruang')
                                $('#ruang').trigger('change')
                                $('#startTime').val('07:00')
                                $('#endTime').val('12:00')
                                $('#resetData').click()
                                $('#resetData').show();
                                modalAdd.show();
                            }
                        }
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
                    eventClick: function(arg) {
                        let id = arg.event.id
                        let data = datas.find(d => d.id == id)
                        console.log(data)

                        if (data.id !== 'undefined') {
                            $('#resetData').hide()
                            $('#title').val(data.kegiatan)
                            $('#ruang').val(data.id_ruang)
                            $('#ruang').trigger('change')
                            calendar_picker.setDate(data.start)
                            $('#keterangan').html(data.keterangan)
                            $('#startTime').val(moment(data.start).format('HH:mm'))
                            $('#endTime').val(moment(data.end).format('HH:mm'))
                            $('#edit,#delete').attr('data-id', id)
                            modalAdd.show()
                        } else {
                            alert("Jadwal tidak ditemukan");
                        }
                    },
                });

                calendar.render();

    //datetime picker flatpickr js
                calendar_picker = $("#startDate").flatpickr(
                    {
                        altInput: true,
                        altFormat: "F j, Y",
                        locale: 'id',
                        dateFormat: "Y-m-d",
                        locale: 'id',
                    }
                );

                $("#startTime").flatpickr(
                    {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        locale: 'id',
                        minTime: "07:00",
                        maxTime: "16:00"
                    }
                );

                $("#endTime").flatpickr(
                    {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        locale: 'id',
                        minTime: "08:00",
                        maxTime: "16:00"
                    }
                );

    //select search js
                $('.js-example-basic-single').select2();


            });

        </script>
    @endpush
</x-app-layout>
