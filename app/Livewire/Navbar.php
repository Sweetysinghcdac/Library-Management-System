<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Actions\Logout;
class Navbar extends Component
{
    public function logout(Logout $logout)
    {
        $logout();
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
