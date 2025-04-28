<x-default-layout>
    @if (session('success'))
        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 justify-items-center">
            @foreach($barangs as $barang)
                <div class="bg-white shadow-md rounded-lg overflow-hidden w-full max-w-sm flex flex-col">
                    @if($barang->gambar)
                        <img src="{{ asset('storage/' . $barang->gambar) }}" 
                            class="w-full h-48 object-cover" 
                            alt="Gambar Barang">
                    @else
                        <img src="https://via.placeholder.com/400x300?text=No+Image" 
                            class="w-full h-48 object-cover" 
                            alt="No Image">
                    @endif

                    <div class="p-4 flex flex-col flex-grow">
                        <h5 class="text-lg font-semibold text-gray-800 mb-1">{{ $barang->nama }}</h5>
                        <p class="text-sm text-gray-600 mb-1">Harga: Rp{{ number_format($barang->harga, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600 mb-1">Penjual: {{ $barang->user->name }}</p>

                        @if($barang->kategori)
                            <p class="text-sm text-gray-600 mb-2">Kategori: {{ $barang->kategori->name }}</p>
                        @endif

                        <p class="text-sm text-gray-700 mb-4">{{ Str::limit($barang->deskripsi, 80) }}</p>

                        <div class="mt-auto flex justify-between items-center">
                            <a href="{{ route('barangs.show', $barang->id) }}" 
                                class="text-sm text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded">Detail</a>

                            @auth
                                @if($barang->user_id === auth()->id())
                                    <span class="text-xs text-gray-500 bg-gray-200 px-2 py-1 rounded">Barang Anda</span>
                                @elseif($barang->status === 'tersedia')
                                    <form action="{{ route('barangs.beli', $barang->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                            class="text-sm text-white bg-green-500 hover:bg-green-600 px-3 py-1 rounded">Beli</button>
                                    </form>
                                @else
                                    <span class="text-xs text-white bg-red-500 px-2 py-1 rounded">Barang Terjual</span>
                                @endif
                            @else
                                <a href="{{ route('login') }}" 
                                    class="text-sm text-white bg-green-500 hover:bg-green-600 px-3 py-1 rounded">Beli</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-default-layout>
