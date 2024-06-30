<?php

namespace App\Trait;

trait CheckHttpCode
{
    public function isSuccess(int $code): bool
    {
        return ((int) ($code / 100)) === 2;
    }
}