<?php

declare(strict_types=1);

namespace App\Entity\Response;

use App\Entity\User;

class RegisterUserResponse
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
