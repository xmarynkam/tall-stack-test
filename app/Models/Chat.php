<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @package App\Models
 *
 * @property int $id
 * @property int $sender_id
 * @property-read User $sender
 * @property int $receiver_id
 * @property-read User $receiver
 * @property ?CarbonInterface $created_at
 * @property ?CarbonInterface $updated_at
 * @property Collection<Message> $messages
 */
class Chat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sender_id',
        'receiver_id',
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
