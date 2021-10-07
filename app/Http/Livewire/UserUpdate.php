<?php

namespace App\Http\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Component;

class UserUpdate extends Component
{

    public $user;
    public $name;
    public $password;

    public function mount()
    {

        $this->user = auth()->user();
        $this->name = $this->user->name;
    }

    public function update()
    {
        $data = $this->validate([
            'name' => 'required|max:255|min:3',
            'password' => 'nullable|string',
        ]);

        if( is_null($data['password']) ){
            unset($data['password']);
        }

        $this->user->update($data);
        $this->dispatchBrowserEvent('notification', ['msg' => 'Profile Updated!' ,]);
    }

    public function render()
    {
        return view('livewire.user-update');
    }
}
