<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Livewire\Actions\Logout;

class AdminNavbar extends Component
{
    public function logout(Logout $logout)
    {
        $logout();
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.admin-navbar');
    }
}
