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
        <link href="assets/css/fullcalendarcustom.css" rel="stylesheet"/>
        <link href="assets/css/flatpickr.min.css" rel="stylesheet"/>
        <link href="assets/css/select2.min.css" rel="stylesheet"/>
        <script src="assets/js/jquery-3.6.3.js"></script>
        <script src="assets/js/fullcalendar-6.0.3.js"></script>
        <script src="assets/js/flowbite.min.js"></script>
        <script src="assets/js/moment-with-locales.min.js"></script>
        <script src="assets/js/flatpickr.min.js"></script>
        <script src="assets/js/flatpickr-locale-4.6.13-id.js"></script>
        <script src="assets/js/selectize.min.js"></script>
        <script src="assets/js/select2.min.js"></script>

        <script>
            let datas = {{ Js::from($datas) }};
            let calendar;
            let calendar_picker;
            let calendar_picker_edit;
            let timeStart;
            let timeEnd;

            $( document ).ready(function() {
    // modal jadwal show or hide
                const $modalAdd = $('#modalAdd')[0];
                const $modalEdit = $('#modalEdit')[0];
                const options = {
                    backdrop: 'static',
                    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
                    closable: false,
                };

                const modalAdd = new Modal($modalAdd, options);
                const modalEdit = new Modal($modalEdit, options);

                @if (count($errors) > 0)
                    modalAdd.show();
                @endif

                $('#closeModalAdd').click(function(){
                    modalAdd.hide();
                });

                $('#closeModalEdit').click(function(){
                    modalEdit.hide();
                });

    //fullcalendar js
                let calendarEl = $('#calendar')[0];
                    calendar = new FullCalendar.Calendar(calendarEl, {
                    events: datas,
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,today,next tambahButton',
                        center: 'title',
                        right: 'listMonth dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    buttonText: {
                        today: 'hari ini',
                        month: 'bulan',
                        week: 'minggu',
                        day: 'hari',
                        listMonth: 'seluruh jadwal'
                    },
                    noEventsContent: 'Tidak ada jadwal untuk ditampilkan',
                    customButtons: {
                        tambahButton: {
                            text: '+ Tambah Jadwal',
                            click: function() {
                                // $('#jadwalForm').attr('action', 'jadwal/store');
                                // $('#judul').html('Tambah Jadwal Pemakaian Ruang')
                                // $('#title').val('')
                                // $('#ruang').val('Pilih Ruang')
                                // $('#ruang').trigger('change')
                                // $('#keterangan').html('')
                                // $('#delbtn').hide()
                                calendar_picker.setDate(moment().format())
                                $('#startTime').val('08:00')
                                $('#endTime').val('11:00')
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
                    eventClick: function(info) {
                        let id = info.event.id
                        let data = datas.find(d => d.id == id)

                        if (data.id !== 'undefined') {
                            $('#jadwalEditForm').attr('action', '{{ route('jadwal.store') }}'+'/'+id);
                            $('#titleEdit').val(data.kegiatan)
                            $('#ruangEdit').val(data.id_ruang)
                            $('#ruangEdit').trigger('change')
                            calendar_picker_edit.setDate(data.start)
                            $('#keteranganEdit').val(data.keterangan)
                            $('#startTimeEdit').val(moment(data.start).format('HH:mm'))
                            $('#endTimeEdit').val(moment(data.end).format('HH:mm'))
                            // $('#delbtn').show()
                            modalEdit.show()
                        } else {
                            alert("Jadwal tidak ditemukan");
                        }
                    }
                });

                calendar.render();

    //datetime picker flatpickr js form add
                calendar_picker = $("#startDate").flatpickr(
                    {
                        altInput: true,
                        altFormat: "F j, Y",
                        locale: 'id',
                        dateFormat: "Y-m-d",
                        locale: 'id',
                    }
                );

                timeStart = $("#startTime").flatpickr(
                    {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        locale: 'id',
                        minTime: "07:00",
                        maxTime: "16:00",
                        defaultHour: "07"
                    }
                );

                timeEnd = $("#endTime").flatpickr(
                    {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        locale: 'id',
                        minTime: "08:00",
                        maxTime: "16:00",
                        defaultHour: "12"
                    }
                );

    //datetime picker flatpickr js form edit
                calendar_picker_edit = $("#startDateEdit").flatpickr(
                    {
                        altInput: true,
                        altFormat: "F j, Y",
                        locale: 'id',
                        dateFormat: "Y-m-d",
                        locale: 'id',
                    }
                );

                timeStart = $("#startTimeEdit").flatpickr(
                    {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        locale: 'id',
                        minTime: "07:00",
                        maxTime: "16:00",
                        defaultHour: "07"
                    }
                );

                timeEnd = $("#endTimeEdit").flatpickr(
                    {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        locale: 'id',
                        minTime: "08:00",
                        maxTime: "16:00",
                        defaultHour: "12"
                    }
                );

    //select search js
                $('.js-example-basic-single').select2();

            });

        </script>
    @endpush
</x-app-layout>
