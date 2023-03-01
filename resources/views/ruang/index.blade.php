<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Ruang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div id="ruang">
                        @include('ruang.layout.table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('jadwal.layout.modal') --}}

    @push('scripts')
        <link href="assets/css/fullcalendarcustom.css" rel="stylesheet"/>
        <link href="assets/css/flatpickr.min.css" rel="stylesheet"/>
        <link href="assets/css/select2.min.css" rel="stylesheet"/>
        <link href="assets/css/toastr.min.css" rel="stylesheet"/>
        <script src="assets/js/jquery-3.6.3.js"></script>
        <script src="assets/js/fullcalendar-6.0.3.js"></script>
        <script src="assets/js/flowbite.min.js"></script>
        <script src="assets/js/moment-with-locales.min.js"></script>
        <script src="assets/js/flatpickr.min.js"></script>
        <script src="assets/js/flatpickr-locale-4.6.13-id.js"></script>
        <script src="assets/js/selectize.min.js"></script>
        <script src="assets/js/select2.min.js"></script>
        <script src="assets/js/toastr.min.js"></script>
        
        <script>
            $(document).ready(function() {

            })
        </script>
    @endpush
</x-app-layout>