<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Contato;

class ContatoPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user, Contato $contato) {
        return $user->id === $contato->user_id;
    }
}
