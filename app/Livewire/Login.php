<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function login(Request $request){
        $validated = $this->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if (Auth::guard('admin')->attempt($validated)) {
            $request->session()->regenerate();
            return $this->redirect('/');
        }
        
        $this->addError('password', 'The provided credentials do not match our records.');
    }
    public function render()
    {
        return view('livewire.login')->layout('components.layouts.app-default');
    }
}
