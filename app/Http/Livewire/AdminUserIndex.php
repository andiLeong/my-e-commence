<?php
namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminUserIndex extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin-user-index',[
            'users' => User::latest()->paginate(10),
        ]);
    }
}
