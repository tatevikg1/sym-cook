<?php

namespace App\Entity\Request;

use Attribute;
use Symfony\Component\Validator\Constraints as Assert;

#[Attribute] class RegisterRequest extends BaseRequest
{
    /**
     * @Assert\Blank()
     */
    protected string $email;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min = 4, max = 6)
     */
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