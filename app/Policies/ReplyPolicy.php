<?php

namespace App\Policies;

use App\Models\Reply;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReplyPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Reply $reply): bool
    {
        return $user->isAdmin() || $user->id === $reply->ticket->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Ticket $ticket): bool
    {
        return $user->isAdmin() || $user->id === $ticket->user_id;
    }
}
