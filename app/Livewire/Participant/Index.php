<?php

declare(strict_types=1);

namespace App\Livewire\Participant;

use App\Models\Chat;
use App\Models\User;
use App\QueryTaps\BetweenParticipantsTap;
use App\Services\ConversationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

final class Index extends Component
{
    private ConversationService $conversationService;

    public function boot(ConversationService $conversationService): void
    {
        $this->conversationService = $conversationService;
    }

    public function render(): View
    {
        $participants = User::query()
            ->whereNot('id', auth()->id())
            ->get();

        return view('livewire.participant.index', compact('participants'));
    }

    public function message(int $userId): RedirectResponse|Redirector
    {
        $authUserId = auth()->id();

        $existingConversation = Chat::query()
            ->tap(new BetweenParticipantsTap($authUserId, $userId))
            ->first();

        if ($existingConversation !== null) {
            return redirect()->route('chats.show', $existingConversation->id);
        }

        $newConversation = $this->conversationService->create($authUserId, $userId);

        return redirect()->route('chats.show', $newConversation->id);
    }
}
