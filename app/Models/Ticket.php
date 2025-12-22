<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    public const STATUS_OPEN = 'open';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_CLOSED = 'closed';
    protected $fillable = ['title', 'description', 'status', 'user_id'];

    protected $casts = [
        'closed_at' => 'datetime',
    ];

    public function isOpen(): bool{
        return $this->getAttribute('status') === self::STATUS_OPEN;
    }

    public function isInProgress(): bool{
        return $this->getAttribute('status') === self::STATUS_IN_PROGRESS;
    }

    public function isClosed(): bool{
        return $this->getAttribute('status') === self::STATUS_CLOSED;
    }

    public function close(){
        if($this->isClosed()){
            return;
        }
        $this->setAttribute('status', self::STATUS_CLOSED);
        $this->setAttribute('closed_at', now());
        $this->save();
    }

    public function replies(): HasMany{
        return $this->hasMany(Reply::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
