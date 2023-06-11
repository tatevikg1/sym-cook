<?php

namespace App\Controller;

use App\Entity\Request\RequestInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseController extends AbstractController
{
    protected ValidatorInterface $validator;

    public function __construct(
        ValidatorInterface $validator,
    ) {
        $this->validator = $validator;
    }

    protected function validate(RequestInterface $request): void
    {
        $errors = $this->validator->validate($request);
        if (count($errors) > 0) {
            throw new ValidatorException($errors);
        }
    }
}
