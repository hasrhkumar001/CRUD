<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use Auth;

class Navbar extends Component
{
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $this->redirect('/login',navigate:true);
    }
    public function render()
    {
        return view('livewire.navbar');
    }
}
