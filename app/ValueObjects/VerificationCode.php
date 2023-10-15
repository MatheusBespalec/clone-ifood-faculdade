<?php

namespace App\ValueObjects;

use InvalidArgumentException;

class VerificationCode
{
    public function __construct(private string $number = "")
    {
        if ($this->number === "") {
            $this->number = (string) rand(100000, 999999);
        }

        $this->validate();
    }

    private function validate(): void
    {
        if (!preg_match("/^[0-9]{6}$/", $this->number)) {
            throw new InvalidArgumentException("verification code must be contains 6 digits");
        }
    }

    public function getNumber(): string
    {
        return $this->number;
    }
}
