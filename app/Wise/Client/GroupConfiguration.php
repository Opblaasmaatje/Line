<?php

namespace App\Wise\Client;

readonly class GroupConfiguration
{
    public function __construct(
        protected string $code,
        protected string $id,
    ){
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
