<?php

namespace App\Entity\Request;

use App\Entity\User;
use App\Validator\UniqueForTable;
use Attribute;
use Symfony\Component\Validator\Constraints as Assert;

#[\Attribute] class RegisterRequest extends BaseRequest
{
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    #[Assert\Email]
    #[UniqueForTable([User::class, 'email'])]
    protected string $email;

    #[Assert\Type('string')]
    #[Assert\NotBlank]
    protected string $password;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}
