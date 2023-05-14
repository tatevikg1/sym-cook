<?php

namespace App\Service;

use App\Entity\Request\RequestInterface;
use App\Entity\Response\RegisterUserResponse;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationService
{
    private UserPasswordHasherInterface $passwordHasher;
    private EntityManagerInterface $entityManager;

    public function __construct(UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager)
    {
        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
    }

    public function registerUser(RequestInterface $request): RegisterUserResponse
    {
        $user = new User();
        $plaintextPassword = $request->getPassword();
        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setRoles(['ROLE_USER']);
        $user->setEmail($request->getEmail());
        $user->setPassword($hashedPassword);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return new RegisterUserResponse($user);
    }
}