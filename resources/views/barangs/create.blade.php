<x-default-layout>
    <div class="mx-auto max-w-2xl">
        <form action="{{ url('/barangs') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col gap-4 px-6 py-4 bg-white border border-zinc-300 shadow col-span-3 md:col-span-2">
            @csrf
            @method("POST")

            <div class="grid sm:grid-cols-2 gap-4">
                <div class="flex flex-col gap-2">
                    <label for="nama">Nama Barang</label>
                    <input type="text" id="nama" name="nama"
                        class="px-3 py-2 border border-zinc-300 bg-slate-50"
                        placeholder="Nama Barang" value="{{ old('nama') }}">
                    @error('nama')
                        <div class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label for="harga">Harga</label>
                    <input type="number" id="harga" name="harga" step="0.01"
                        class="px-3 py-2 border border-zinc-300 bg-slate-50"
                        placeholder="Harga Barang" value="{{ old('harga') }}">
                    @error('harga')
                        <div class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori_id"
                    class="px-3 py-2 border border-zinc-300 appearance-none bg-slate-50" required>
                    <option value="" disabled {{ old('kategori_id') == '' ? 'selected' : '' }}>Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->name }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3"
                    class="px-3 py-2 border border-zinc-300 bg-slate-50"
                    placeholder="Deskripsi Barang">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="status">Status</label>
                <select id="status" name="status"
                    class="px-3 py-2 border border-zinc-300 appearance-none bg-slate-50">
                    <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="terjual" {{ old('status') == 'terjual' ? 'selected' : '' }}>Terjual</option>
                </select>
                @error('status')
                    <div class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="gambar">Upload Gambar</label>
                <input type="file" id="gambar" name="gambar" accept="image/*"
                    class="px-3 py-2 border border-zinc-300 bg-slate-50">
                @error('gambar')
                    <div class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="self-end flex gap-2">
                <a href="{{ url('/barangs/jual') }}"
                    class="bg-slate-50 border border-slate-500 text-slate-500 px-3 py-2 cursor-pointer">
                    Batal
                </a>
                <button type="submit"
                    class="bg-blue-50 border border-blue-500 text-blue-500 px-3 py-2 flex items-center gap-2 cursor-pointer">
                    <i class="ph ph-floppy-disk block text-blue-500"></i>
                    <span>Simpan</span>
                </button>
            </div>
        </form>
    </div>
</x-default-layout>
