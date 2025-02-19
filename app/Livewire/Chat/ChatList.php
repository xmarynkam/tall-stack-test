<?php

declare(strict_types=1);

namespace App\Livewire\Chat;

use Illuminate\View\View;
use Livewire\Component;

class ChatList extends Component
{
    public function render(): View
    {
        return view('livewire.chat.chat-list');
    }
}
