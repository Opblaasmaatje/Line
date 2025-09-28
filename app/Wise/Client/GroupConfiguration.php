<?php

namespace App\Wise\Client;

readonly class GroupConfiguration
{
    public function __construct(
        protected string $code,
        protected int $id,
    ){
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
