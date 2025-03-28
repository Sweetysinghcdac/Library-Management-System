<?php

namespace App\Livewire\Visitor;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
class Dashboard extends Component
{
    
        public $bookings;

        public function mount()
        {
            $this->bookings = Booking::with('book')
                ->where('user_id', Auth::id())
                ->latest()
                ->get();
        }
    
        public function render()
        {
            return view('livewire.visitor.dashboard')->layout('layouts.visitor');
        }
    }

