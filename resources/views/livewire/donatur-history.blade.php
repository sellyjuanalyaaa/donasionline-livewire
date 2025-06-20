<div>
    <div class="container py-4">
        <h3 class="mb-4">Riwayat Donasi Anda</h3>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Kampanye Donasi</th>
                                <th scope="col">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($donations as $donation)
                                <tr>
                                    <th scope="row">{{ $loop->iteration + ($donations->currentPage() - 1) * $donations->perPage() }}</th>
                                    <td>{{ $donation->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        {{ $donation->kampanye->judul ?? 'Kampanye tidak ditemukan' }}
                                    </td>
                                    <td>Rp {{ number_format($donation->jumlah_donasi, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        Anda belum pernah melakukan donasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $donations->links() }}
                </div>
            </div>
        </div>
    </div>
</div>