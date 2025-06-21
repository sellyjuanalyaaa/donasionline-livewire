<?php

namespace App\Livewire;

use App\Models\Donasi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DonaturHistory extends Component
{
    use WithPagination;

    public function render()
    {
        $donations = Donasi::where('id', -1)->paginate(10); 

        if (Auth::guard('donatur')->check()) {

            $donations = Donasi::where('donatur_id', Auth::guard('donatur')->id())
                        ->with('kampanye')
                        ->latest()
                        ->paginate(10);
        }

        return view('livewire.donatur-history', [
            'donations' => $donations,
        ]);
    }
}
