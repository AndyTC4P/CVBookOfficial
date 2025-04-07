<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class DeleteUserForm extends Component
{
    public string $password = '';

    public function deleteUser(): void
{
    \Log::info('Entró al método deleteUser');

    $this->validate([
        'password' => ['required', 'string', 'current_password'],
    ]);

    $user = auth()->user();

    auth()->logout();
    $user->delete();

    session()->invalidate();
    session()->regenerateToken();

    $this->redirect('/', navigate: true);
}


    public function render()
    {
        return view('livewire.profile.delete-user-form');
    }
}

