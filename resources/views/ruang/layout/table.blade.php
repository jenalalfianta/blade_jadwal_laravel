<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                Kode Ruang
            </th>
            <th scope="col" class="px-6 py-3">
                Nama Ruang
            </th>
            <th scope="col" class="px-6 py-3">
                Lantai
            </th>
            <th scope="col" class="px-6 py-3">
                Action
            </th>
        </tr>
    </thead>
    <tbody>
        @if ($ruangs->count() == 0)
        <tr>
            <td colspan="5">Tidak ada data ruang untuk ditampilkan.</td>
        </tr>
        @endif

        @foreach ($ruangs as $ruang)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="px-6 py-4">{{ $ruang->kode_ruang }}</td>
            <td class="px-6 py-4">{{ $ruang->nama_ruang }}</td>
            <td class="px-6 py-4">{{ $ruang->lantai_ruang }}</td>
            <td class="px-6 py-4">
                <a class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 mr-1 mb-1 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Edit</a>
                <form style="display:inline-block" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-2 mr-1 mb-1 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $ruangs->links() }}

<p class="pt-5">
    Menampilkan {{$ruangs->count()}} dari {{ $ruangs->total() }} ruang.
</p>