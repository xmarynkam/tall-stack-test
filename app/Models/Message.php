<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @package App\Models
 *
 * @property int $id
 * @property int $chat_id
 * @property-read Chat $chat
 * @property string $body
 * @property int $sender_id
 * @property-read User $sender
 * @property int $receiver_id
 * @property-read User $receiver
 * @property ?CarbonInterface $sender_deleted_at
 * @property ?CarbonInterface $receiver_deleted_at
 * @property ?CarbonInterface $read_at
 * @property ?CarbonInterface $created_at
 * @property ?CarbonInterface $updated_at
 */
class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'chat_id',
        'body',
        'sender_id',
        'receiver_id',
        'read_at',
    ];

    protected $casts = [
        'sender_deleted_at' => 'datetime',
        'receiver_deleted_at' => 'datetime',
        'read_at' => 'datetime',
    ];

    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function isRead(): bool
    {
        return $this->read_at !== null;
    }
}
