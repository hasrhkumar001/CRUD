<?php

namespace App\Livewire;

use App\Models\Users;
use Livewire\Component;


class AddUser extends Component
{
    
    public $name ='';
    public $email ='';
    public $password ='';
    

    
    
    public function saveUser(){
        $this->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
            
        ]);
    
        $new_user =new Users;
        $new_user->name =$this->name;
        $new_user->email=$this->email;
        $new_user->password =bcrypt($this->password);
        
        
        $new_user->save();
        
        return $this->redirect('/users',navigate:true);
    }

    public function render()
    {
        return view('livewire.add-user');
    }
}
