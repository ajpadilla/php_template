<?php

namespace Template\Php\Services;

interface PaymentGatewayServiceInterface
{
    public function charge(array $customer, float $amount, float $tax): bool;
}