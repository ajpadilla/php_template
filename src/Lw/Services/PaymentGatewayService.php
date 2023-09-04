<?php

namespace Template\Php\Services;

class PaymentGatewayService implements PaymentGatewayServiceInterface
{

    public function charge(array $customer, float $amount, float $tax): bool
    {
        var_dump($customer, $amount, $tax);
    }
}