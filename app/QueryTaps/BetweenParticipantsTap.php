<?php

declare(strict_types=1);

namespace App\QueryTaps;

use Illuminate\Database\Eloquent\Builder;

readonly class BetweenParticipantsTap
{
    public function __construct(
        private int $senderId,
        private int $receiverId,
    ) {}

    public function __invoke(Builder $builder): void
    {
        $builder->where(
            fn (Builder $builder) => $builder
                ->where('sender_id', $this->senderId)
                ->where('receiver_id', $this->receiverId)
        )->orWhere(
            fn (Builder $builder) => $builder
                ->where('sender_id', $this->receiverId)
                ->where('receiver_id', $this->senderId)
        );
    }
}
