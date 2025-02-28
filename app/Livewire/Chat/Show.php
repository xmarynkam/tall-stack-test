<?php

declare(strict_types=1);

namespace App\Livewire\Chat;

use App\Models\Chat;
use Illuminate\View\View;
use Livewire\Component;

class Show extends Component
{
    public function mount(Chat $chat)
    {
//        dd($chat);
    }

    public function render(): View
    {
        return view('livewire.chat.show');
    }
}
