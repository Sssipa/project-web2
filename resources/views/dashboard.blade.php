<x-default-layout>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-2xl font-bold text-gray-800">Riwayat Pembelian</h2>
        @if(session('success'))
            <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">No</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Nama Barang</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Harga</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Tanggal Pembelian</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status Pembelian</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembelians as $index => $pembelian)
                        <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $pembelian->barang->nama }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">Rp {{ number_format($pembelian->barang->harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $pembelian->created_at->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                @if($pembelian->status == 'in progress')
                                    <span class="text-blue-500">In Progress</span>
                                @elseif($pembelian->status == 'completed')
                                    <span class="text-green
                                    -500">Completed</span>
                                @elseif($pembelian->status == 'canceled')
                                    <span class="text-red-500">Canceled</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($pembelian->status !== 'completed')
                                    <form action="{{ route('pembelians.destroy', $pembelian->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="px-4 py-2 text-sm text-white bg-red-500 rounded-md shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                            onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                            Batalkan Pesanan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm">Tidak dapat dibatalkan</span>
                                @endif
                            </td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-default-layout>