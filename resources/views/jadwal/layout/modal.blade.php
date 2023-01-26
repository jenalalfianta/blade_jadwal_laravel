
<!-- Modal toggle -->
<button id="openModal" data-modal-target="modal" data-modal-toggle="modal" class="invisible block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    Toggle modal
</button>

<!-- Main modal -->
<div id="modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div id="close" class="relative w-full h-full max-w-md md:h-auto">
        <!-- Modal content -->
        <div id="modal" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button id="closeModal" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Tambah Jadwal Pemakaian Ruang</h3>
                <form class="space-y-6" action="#">

                @csrf
                    <div>
                    <label for="title" class="flex-grow  block font-medium text-sm text-gray-700 mb-1">Nama Kegiatan</label>
                    <input id="title" type="text" name="title"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ketik disini.." required>
                    <div class="py-3 text-red-700">
                        <p id="titleError"></p>
                    </div>
                    <div>
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Ruang</label>
                    <select name="ruang" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Pilih Ruang</option>
                    <option value="Auditorium">Auditorium</option>
                    </select>
                    <div class="py-3 text-red-700">
                        <p id="ruangError"></p>
                    </div>
                    <div>
                    <label for="startDate" class="flex-grow  block font-medium text-sm text-gray-700 mb-1">Tanggal Kegiatan</label>
                    <input id="startDate" type="text" name="startDate"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ketik disini.." required>
                    <div class="py-3 text-red-700">
                        <p id="startDateError"></p>
                    </div>
                    <div>
                    <label for="startTime" class="flex-grow  block font-medium text-sm text-gray-700 mb-1">Jam Mulai Kegiatan</label>
                    <input id="startTime" type="text" name="startTime"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="07:00" required>
                    <div class="py-3 text-red-700">
                        <p id="startTimeError"></p>
                    </div>
                    <div>
                    <label for="endTime" class="flex-grow  block font-medium text-sm text-gray-700 mb-1">Jam Selesai Kegiatan</label>
                    <input id="endTime" type="text" name="endTime"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="07:00" required>
                    <div class="py-3 text-red-700">
                        <p id="endTimeError"></p>
                    </div>
                    <div>
                    <label for="keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                    <textarea id="keterangan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Misalnya pihak external, prodi, dsb.."></textarea>
                    <div class="py-3 text-red-700">
                        <p id="keteranganError"></p>
                    </div>
                    
                    {{-- <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Ruang</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div> --}}
                    {{-- <div class="flex justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" type="checkbox" value="" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" required>
                            </div>
                            <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remember me</label>
                        </div>
                        <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500">Lost Password?</a>
                    </div> --}}
                    <button id="saveDate" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800  mt-5">Simpan Jadwal</button>
                    {{-- <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        Not registered? <a href="#" class="text-blue-700 hover:underline dark:text-blue-500">Create account</a>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
</div>
