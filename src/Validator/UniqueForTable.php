<?php

namespace App\Validator;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute] class UniqueForTable extends Constraint
{
    public string $message = 'This value is not unique for the given table.';
    private string $table;
    private string  $column;

    public function __construct(array $args, mixed $options = null, array $groups = null, mixed $payload = null)
    {
        parent::__construct($options, $groups, $payload);
        $this->table = $args[0];
        $this->column = $args[1];
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getColumn()
    {
        return $this->column;
    }
}