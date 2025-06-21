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
    public Kampanye $kampanye;

    public $jumlah_donasi;
    public $sisaTarget;

    public function mount($kampanye_id)
    {

        $this->kampanye = Kampanye::where('status', 'aktif')
                            ->withSum('donasis as terkumpul', 'jumlah')
                            ->findOrFail($kampanye_id);

        $this->sisaTarget = $this->kampanye->target_donasi - $this->kampanye->terkumpul;

        if ($this->sisaTarget <= 0) {
            session()->flash('info', 'Target untuk kampanye ini sudah tercapai. Terima kasih atas niat baik Anda.');
            return $this->redirect(route('donatur.dashboard'));
        }
    }

    public function rules()
    {
        return [
            'jumlah_donasi' => ['required', 'numeric', 'min:10000', 'max:' . $this->sisaTarget],
        ];
    }
    
    protected $messages = [
        'jumlah_donasi.max' => 'Jumlah donasi tidak boleh melebihi sisa target yang dibutuhkan.',
    ];

    public function save()
    {
        $this->validate();

        $donaturId = Auth::guard('donatur')->id();

        $donasi = Donasi::create([
            'donatur_id' => $donaturId,
            'kampanye_id' => $this->kampanye->id,
            'jumlah' => $this->jumlah_donasi,
            'tanggal' => now(),
        ]);

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

    public function render()
    {
        return view('livewire.donatur.donasi-form');
    }
}
