<?php

namespace App\Resolver;

use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class CalcMutation implements MutationInterface
{
    private int $value = 0;

    public function addition($number): int
    {
        $this->value += $number;
        return $this->value;
    }
}