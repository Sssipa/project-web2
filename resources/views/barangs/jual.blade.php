<x-default-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Daftar Barang Yang Dijual</h2>
            <a href="{{ route('barangs.create') }}" 
                class="px-4 py-2 bg-blue-500 text-white rounded-md shadow hover:bg-blue-600 transition">
                Tambah Barang
            </a>
        </div>

        <!-- Grid of Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 justify-items-center">
            @foreach($barangs as $barang)
                <div class="bg-white shadow-md rounded-lg overflow-hidden w-full max-w-sm flex flex-col">
                    @if($barang->gambar)
                        <img src="{{ asset('storage/' . $barang->gambar) }}" 
                            alt="Gambar Barang" 
                            class="w-full h-48 object-cover">
                    @else
                        <img src="https://via.placeholder.com/300x200?text=No+Image" 
                            alt="No Image" 
                            class="w-full h-48 object-cover">
                    @endif

                    <div class="p-4 flex flex-col flex-grow">
                        <h5 class="text-lg font-semibold text-gray-800 mb-1">{{ $barang->nama }}</h5>
                        <p class="text-sm text-gray-600 mb-1">Kategori: {{ $barang->kategori->name ?? '-' }}</p>
                        <p class="text-sm text-gray-600 mb-1">Harga: Rp{{ number_format($barang->harga, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600 mb-3">Status: {{ ucfirst($barang->status) }}</p>
                        <p class="text-sm text-gray-700 mb-4">{{ Str::limit($barang->deskripsi, 80) }}</p>

                        <div class="mt-auto flex justify-between items-center">
                            <a href="{{ route('barangs.edit', $barang->id) }}" 
                            class="px-3 py-1 text-sm text-white bg-yellow-500 hover:bg-yellow-600 rounded transition">
                                Edit
                            </a>

                            <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-3 py-1 text-sm text-white bg-red-500 hover:bg-red-600 rounded transition"
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-default-layout>
