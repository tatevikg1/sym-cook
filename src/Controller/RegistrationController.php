<?php
namespace App\Controller;

use App\Entity\Request\RegisterRequest;
use App\Service\RegistrationService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends BaseController
{
    private RegistrationService $registrationService;
    public function __construct(
        ValidatorInterface $validator,
        RegistrationService $registrationService,
    ) {
        parent::__construct($validator);
        $this->registrationService = $registrationService;
    }

    #[Route('/register', name: 'register', requirements: ['request' => RegisterRequest::class], methods: 'POST')]
    public function register(#[RegisterRequest]  $request): JsonResponse
    {
        $this->validate($request);
        $registerUserResponse = $this->registrationService->registerUser($request);

        return $this->json($registerUserResponse);
    }
}