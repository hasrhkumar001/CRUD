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

        if(Auth::attempt($validated)){
            $request->session()->regenerate();
            
            return $this->redirect('/cars',navigate:true);
        }
        $this->addError('email','Wrong email or password');
    }
    public function render()
    {
        return view('livewire.login');
    }
}
