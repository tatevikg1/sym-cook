<?php
namespace App\Controller;

use App\Entity\Request\RegisterRequest;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    private ValidatorInterface $validator;
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    #[Route('/register', name: 'register', requirements: ['request' => RegisterRequest::class], methods: 'POST')]
    public function register(#[RegisterRequest]  $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $user = new User();
        $plaintextPassword = $request->getPassword();

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setRoles(['ROLE_USER']);
        $user->setEmail($request->getEmail());
        $user->setPassword($hashedPassword);
        $errors = $this->validator->validate($request);
        dd($errors);
        return new JsonResponse(['success' => true, 'user' => $user]);
    }
}