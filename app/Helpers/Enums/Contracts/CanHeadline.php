<?php

namespace App\Helpers\Enums\Contracts;

interface CanHeadline
{
    public function toHeadline(): string;

    public static function fromHeadline(string $headline): self;
}
