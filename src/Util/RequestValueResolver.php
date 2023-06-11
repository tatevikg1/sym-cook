<?php

namespace App\Util;

use App\Entity\Request\RegisterRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class RequestValueResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        foreach ($argument->getAttributes() as $attribute) {
            if (is_subclass_of($attribute, Request::class)) {
                return true;
            }
        }

        return false;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $requestClass = RegisterRequest::class;
        yield forward_static_call([$requestClass, 'createFromGlobals']);
    }
}
