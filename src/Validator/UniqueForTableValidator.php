<?php

namespace App\Validator;

use Attribute;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

#[Attribute] class UniqueForTableValidator extends ConstraintValidator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof UniqueForTable) {
            throw new \InvalidArgumentException(sprintf('The constraint must be an instance of %s.', UniqueForTable::class));
        }

        $repository = $this->entityManager->getRepository($constraint->getTable());
        $existingEntity = $repository->findOneBy([$constraint->getColumn() => $value]);

        if ($existingEntity !== null) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}