<?php

namespace App\Http\Livewire;


use App\Jobs\DeleteImage;
use App\Models\User;
use Illuminate\Support\Facades\Bus;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminUserUpdate extends Component
{
    use WithFileUploads;
    use FileUploaderHandler;

    public $user_id;
    public $user;
    public $name;
    public $email;
    public $is_admin;
    public $photo;
    public $profile_image;

    public function mount()
    {
        $this->user = User::findOrFail($this->user_id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->is_admin = $this->user->is_admin;
        $this->profile_image = $this->user->profile_img;
    }

    public function update()
    {
        $data = $this->validate([
            'email' => ['required','string','max:255','min:5',Rule::unique('users', 'email')->ignore($this->user)], //ignore your own ]
            'name' => 'required|max:255|min:3',
            'is_admin' => 'boolean|required',
            'photo' => 'nullable|image|max:2048',
        ]);

        if(!is_null($data['photo'])){
            $profile_photo = $this->upload([$data['photo']],  $this->getUserPath() )[0];
            if($this->user->hasProfilePicture()){
                Bus::dispatch(New DeleteImage(  $this->user->getRawOriginal()['profile_img'] ));
            }
            $data['profile_img'] = $profile_photo;
        }
        unset($data['photo']);
        $this->user->update($data);
        $this->dispatchBrowserEvent('notification', ['msg' => 'Updated User!' ,]);

    }

    public function render()
    {
        return view('livewire.admin-user-update');
    }
}
