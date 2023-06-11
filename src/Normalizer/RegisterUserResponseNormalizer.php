<?php

declare(strict_types=1);

namespace App\Normalizer;

use App\Constant\ResponseStatus;
use App\Entity\Response\RegisterUserResponse;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RegisterUserResponseNormalizer implements NormalizerInterface
{
    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'status' => ResponseStatus::SUCCESS,
            'data' => [
                'id' => $object->getUser()->getId(),
                'email' => $object->getUser()->getEmail(),
            ],
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof RegisterUserResponse;
    }
}
