<?php

namespace App\Livewire\Donatur;

use App\Models\Donasi;
use App\Models\Kampanye;
use App\Models\TransaksiDonasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DonasiForm extends Component
{
    // Properti untuk menampung data kampanye yang dipilih dari URL
    public Kampanye $kampanye;

    public $jumlah_donasi;
    public $sisaTarget;

    /**
     * Lifecycle hook yang berjalan saat komponen dimuat.
     * Menerima kampanye_id dari URL secara otomatis.
     */
    public function mount($kampanye_id)
    {
        // Cari kampanye yang aktif, lalu hitung total donasinya
        $this->kampanye = Kampanye::where('status', 'aktif')
                            ->withSum('donasis as terkumpul', 'jumlah')
                            ->findOrFail($kampanye_id);
                            
        // Hitung sisa target yang dibutuhkan
        $this->sisaTarget = $this->kampanye->target_donasi - $this->kampanye->terkumpul;

        // Jika target sudah tercapai, jangan biarkan donatur masuk ke form ini
        if ($this->sisaTarget <= 0) {
            session()->flash('info', 'Target untuk kampanye ini sudah tercapai. Terima kasih atas niat baik Anda.');
            return $this->redirect(route('donatur.dashboard'));
        }
    }

    /**
     * Aturan validasi dinamis.
     */
    public function rules()
    {
        return [
            // Donasi tidak boleh melebihi sisa target
            'jumlah_donasi' => ['required', 'numeric', 'min:10000', 'max:' . $this->sisaTarget],
        ];
    }
    
    protected $messages = [
        'jumlah_donasi.max' => 'Jumlah donasi tidak boleh melebihi sisa target yang dibutuhkan.',
    ];

    /**
     * Method untuk menyimpan donasi.
     */
    public function save()
    {
        $this->validate();

        $donaturId = Auth::guard('donatur')->id();

        // Simpan ke tabel 'donasis'
        $donasi = Donasi::create([
            'donatur_id' => $donaturId,
            'kampanye_id' => $this->kampanye->id,
            'jumlah' => $this->jumlah_donasi,
            'tanggal' => now(),
        ]);

        // Simpan juga ke tabel 'transaksi_donasis'
        if ($donasi) {
            TransaksiDonasi::create([
                'kode_transaksi' => 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5)),
                'donatur_id' => $donaturId,
                'kampanye_id' => $this->kampanye->id,
                'jumlah' => $this->jumlah_donasi,
                'status' => 'berhasil',
                'metode_pembayaran' => 'Langsung',
            ]);
        }

        session()->flash('success', 'Terima kasih! Donasi Anda telah diterima.');
        return $this->redirect(route('donatur.riwayat'), navigate: true);
    }

    /**
     * Merender view. Tidak perlu mengirim data kampanye lagi
     * karena sudah ada di properti $this->kampanye.
     */
    public function render()
    {
        return view('livewire.donatur.donasi-form');
    }
}
