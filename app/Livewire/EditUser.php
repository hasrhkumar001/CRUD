<?php

namespace App\Livewire;


use App\Models\Users;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditUser extends Component
{
    use WithFileUploads;
    public $id;
    public $name;
    public $email;
    public $password;
   
    public Users $user_data;

    public function mount($id){
        $this->id=$id;
        $this->user_data= Users::where('id',$id)->first();
        $this->name=$this->user_data->name;
        $this->email=$this->user_data->email;
        $this->password=$this->user_data->password;
        
    }
    public function update(){
        $this->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            
            
        ]);

        try{
            
            
            Users::where('id',$this->id)->update([
                'name'=>$this->name,
                'email'=>$this->email,
                'password'=>bcrypt($this->password),
                
            ]);
            return $this->redirect('/users',navigate:true);
        }catch(\Exception $e){
            dd($e);
        }
    }
   
    public function render()
    {
        return view('livewire.edit-user');
    }
}
