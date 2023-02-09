<!-- Main modal -->
<div id="modalAdd" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div id="close" class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div id="modal" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button id="closeModal" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="text-center text-xl font-bold text-gray-900 dark:text-white">Tambah Jadwal Pemakaian Ruang</h3>
                <form method="post" class="space-y-6" action="{{route('jadwal.store')}}">
                @csrf
                <input type="hidden" name="user" value="{{Auth::user()->id}}">
                    <div>
                        <label for="title" class="flex-grow block font-medium text-sm text-gray-700">Nama Kegiatan</label>
                        <input value="{{ old('title') }}" id="title" type="text" name="title"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Misalnya lokakarya, seminar, kuliah umum dsb..">
                        <x-input-error :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <label for="ruang" class="block text-sm font-medium text-gray-900 dark:text-white">Pilih Ruang</label>
                        <select id="ruang" name="ruang" style="width: 100%"  class="js-example-basic-single bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Pilih Ruang</option>
                        @foreach ($ruangs as $ruang)
                        <option {{ old('ruang') == $ruang->id ? "selected" : "" }} value="{{ $ruang->id }}">{{ $ruang->nama_ruang }}</option>
                        @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('ruang')" class="mt-2" />
                    </div>

                    <div>
                        <label for="startDate" class="flex-grow block font-medium text-sm text-gray-700">Tanggal Kegiatan</label>
                        <input value="{{ old('startDate') }}" name="startDate" id="startDate" type="text"   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih tanggal..">
                        <x-input-error :messages="$errors->get('startDate')" class="mt-2" />
                    </div>

                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="startTime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Mulai Kegiatan</label>
                            <input value="{{old('startTime') ? old('startTime') : '07:00'}}" id="startTime" type="text" name="startTime" value="07:00" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <x-input-error :messages="$errors->get('startTime')" class="mt-2" />
                        </div>
                        <div>
                            <label for="endTime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Selesai Kegiatan</label>
                            <input value="{{old('endTime') ? old('endTime') : '12:00'}}" id="endTime" type="text" name="endTime" value="12:00" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <x-input-error :messages="$errors->get('endTime')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-900 dark:text-white">Keterangan (Opsional)</label>
                        <textarea id="keterangan" name="keterangan" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Misalnya fakultas, prodi, pihak eksternal, dsb..">{{ old('keterangan') }}</textarea>
                        <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                    </div>
                    <button id="saveDate" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan Jadwal</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Main modal -->
<div id="modalEdit" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div id="close" class="relative w-full h-full max-w-2xl md:h-auto">
        <!-- Modal content -->
        <div id="modal" class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button id="closeModal" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="text-center text-xl font-bold text-gray-900 dark:text-white">Tambah Jadwal Pemakaian Ruang</h3>
                <form method="post" class="space-y-6" action="{{route('jadwal.store')}}">
                @csrf
                <input type="hidden" name="user" value="{{Auth::user()->id}}">
                    <div>
                        <label for="title" class="flex-grow block font-medium text-sm text-gray-700">Nama Kegiatan</label>
                        <input value="{{ old('title') }}" id="title" type="text" name="title"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Misalnya lokakarya, seminar, kuliah umum dsb..">
                        <x-input-error :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <label for="ruang" class="block text-sm font-medium text-gray-900 dark:text-white">Pilih Ruang</label>
                        <select id="ruang" name="ruang" style="width: 100%"  class="js-example-basic-single bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Pilih Ruang</option>
                        @foreach ($ruangs as $ruang)
                        <option {{ old('ruang') == $ruang->id ? "selected" : "" }} value="{{ $ruang->id }}">{{ $ruang->nama_ruang }}</option>
                        @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('ruang')" class="mt-2" />
                    </div>

                    <div>
                        <label for="startDate" class="flex-grow block font-medium text-sm text-gray-700">Tanggal Kegiatan</label>
                        <input value="{{ old('startDate') }}" name="startDate" id="startDate" type="text"   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pilih tanggal..">
                        <x-input-error :messages="$errors->get('startDate')" class="mt-2" />
                    </div>

                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <div>
                            <label for="startTime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Mulai Kegiatan</label>
                            <input value="{{old('startTime') ? old('startTime') : '07:00'}}" id="startTime" type="text" name="startTime" value="07:00" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <x-input-error :messages="$errors->get('startTime')" class="mt-2" />
                        </div>
                        <div>
                            <label for="endTime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Selesai Kegiatan</label>
                            <input value="{{old('endTime') ? old('endTime') : '12:00'}}" id="endTime" type="text" name="endTime" value="12:00" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <x-input-error :messages="$errors->get('endTime')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-900 dark:text-white">Keterangan (Opsional)</label>
                        <textarea id="keterangan" name="keterangan" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Misalnya fakultas, prodi, pihak eksternal, dsb..">{{ old('keterangan') }}</textarea>
                        <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                    </div>
                    {{-- <button id="saveDate" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan Jadwal</button> --}}
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                    <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                </form>
            </div>
        </div>
    </div>
</div>
