<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Chat;

class ConversationService
{
    public function create(int $senderId, int $receiverId): Chat
    {
        return Chat::query()
            ->create([
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
            ]);
    }
}
