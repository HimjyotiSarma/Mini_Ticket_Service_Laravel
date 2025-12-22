<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $fillable = ['title', 'description', 'status', 'user_id'];

    protected $casts = [
        'closed_at' => 'datetime',
    ];

    public function isOpen(): bool{
        return $this->getAttribute('status') === 'open';
    }

    public function isInProgress(): bool{
        return $this->getAttribute('status') === 'in_progress';
    }

    public function isClosed(): bool{
        return $this->getAttribute('status') === 'closed';
    }

    public function close(){
        if($this->isClosed()){
            return;
        }
        $this->setAttribute('status', 'closed');
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
