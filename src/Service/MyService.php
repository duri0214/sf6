<?php

namespace App\Service;

class MyService
{
    /**
     * 足し算の結果を返します
     * @param int $operandA
     * @param int $operandB
     * @return int
     */
    public function calcAdd(int $operandA, int $operandB): int {
        return $operandA + $operandB;
    }
}
