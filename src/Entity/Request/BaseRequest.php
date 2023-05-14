<?php

namespace App\Entity\Request;

use Symfony\Component\HttpFoundation\Request;

abstract class BaseRequest extends Request implements RequestInterface
{
    public function __construct(
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null,
    ) {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->setAttributes(json_decode($this->getContent(), true));
    }

    protected function setAttributes(mixed $content): void
    {
        foreach($content as $key => $value) {
            $this->$key = $value;
        }
    }
}