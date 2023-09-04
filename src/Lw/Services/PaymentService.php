<?php

namespace Template\Php\Services;

class PaymentService
{
    public function __construct()
    {
    }

    public function pay(float $amount) {
        echo "Pay amount {$amount}";
    }
}