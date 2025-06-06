<?php

namespace App\Bingo;

trait Makeable
{
    public static function make(...$params): self
    {
        return new self(...$params);
    }
}
