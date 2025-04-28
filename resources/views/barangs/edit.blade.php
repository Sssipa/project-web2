<x-default-layout title="Barang" section_title="Edit Barang">
    <div class="container mx-auto max-w-2xl p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-6">Edit Barang</h2>

        <form action="{{ url('/barangs/' . $barang->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-2">
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                <input type="text" id="nama" name="nama" 
                    value="{{ old('nama', $barang->nama) }}"
                    class="px-3 py-2 border border-zinc-300 bg-slate-50" required>
                @error('nama')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="number" id="harga" name="harga" step="0.01" 
                    value="{{ old('harga', $barang->harga) }}"
                    class="px-3 py-2 border border-zinc-300 bg-slate-50" required>
                @error('harga')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select id="kategori" name="kategori_id" 
                    class="px-3 py-2 border border-zinc-300 bg-slate-50" required>
                    <option value="" disabled {{ old('kategori_id', $barang->kategori_id) ? '' : 'selected' }}>Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $barang->kategori_id) == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->name }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3"
                    class="px-3 py-2 border border-zinc-300 bg-slate-50">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status"
                    class="px-3 py-2 border border-zinc-300 bg-slate-50">
                    <option value="tersedia" {{ old('status', $barang->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="terjual" {{ old('status', $barang->status) == 'terjual' ? 'selected' : '' }}>Terjual</option>
                </select>
                @error('status')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Barang</label>
                <input type="file" id="gambar" name="gambar" accept="image/*"
                    class="px-3 py-2 border border-zinc-300 bg-slate-50">
                @if ($barang->gambar)
                    <img src="{{ asset('storage/' . $barang->gambar) }}" class="mt-2 w-36 h-36 object-cover rounded-md" alt="Gambar Barang">
                @endif
                @error('gambar')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="self-end flex gap-2">
                <a href="{{ url('/barangs/jual') }}" 
                    class="bg-slate-50 border border-slate-500 text-slate-500 px-3 py-2 cursor-pointer">
                    <span>Batal</span>
                </a>
                <button type="submit"
                    class="bg-blue-50 border border-blue-500 text-blue-500 px-3 py-2 flex items-center gap-2 cursor-pointer">
                    <i class="ph ph-floppy-disk block text-blue-500"></i>
                    <span>Update Barang</span>
                </button>
            </div>
        </form>
    </div>
</x-default-layout>
