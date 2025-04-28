<x-default-layout>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-center text-2xl font-bold mb-6">Detail Barang</h2>

        <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6 text-center">
                @if($barang->gambar)
                    <img src="{{ asset('storage/' . $barang->gambar) }}" 
                        class="mx-auto mb-4 w-48 h-48 object-cover rounded-md" 
                        alt="Gambar Barang">
                @else
                    <img src="https://via.placeholder.com/200x150?text=No+Image" 
                        class="mx-auto mb-4 w-48 h-48 object-cover rounded-md" 
                        alt="No Image">
                @endif

                <table class="w-full text-left border-collapse">
                    <tbody>
                        <tr class="border-b">
                            <th class="py-2 px-4 font-medium text-gray-700">Nama Barang</th>
                            <td class="py-2 px-4 text-gray-600">{{ $barang->nama }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="py-2 px-4 font-medium text-gray-700">Kategori</th>
                            <td class="py-2 px-4 text-gray-600">{{ $barang->kategori->name}}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="py-2 px-4 font-medium text-gray-700">Status</th>
                            <td class="py-2 px-4 text-gray-600">{{ ucfirst($barang->status) }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="py-2 px-4 font-medium text-gray-700">Deskripsi</th>
                            <td class="py-2 px-4 text-gray-600">{{ $barang->deskripsi }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="py-2 px-4 font-medium text-gray-700">Harga</th>
                            <td class="py-2 px-4 text-gray-600">Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="py-2 px-4 font-medium text-gray-700">Tanggal Dibuat</th>
                            <td class="py-2 px-4 text-gray-600">{{ $barang->created_at ? $barang->created_at->format('d M Y, H:i') : 'Tanggal tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th class="py-2 px-4 font-medium text-gray-700">Tanggal Diperbarui</th>
                            <td class="py-2 px-4 text-gray-600">{{ $barang->updated_at ? $barang->updated_at->format('d M Y, H:i') : 'Tanggal tidak tersedia' }}</td>
                        </tr>
                    </tbody>
                </table>

                <a href="{{ route('barangs.index') }}" 
                    class="inline-block mt-6 px-4 py-2 bg-gray-500 text-white rounded-md shadow hover:bg-gray-600">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</x-default-layout>