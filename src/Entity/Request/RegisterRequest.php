<?php

namespace App\Entity\Request;

use Attribute;
use Symfony\Component\Validator\Constraints as Assert;

#[Attribute] class RegisterRequest extends BaseRequest
{
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    #[Assert\Email]
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