<?php

namespace Template\Php\Services;

class InvoiceService
{
    private EmailService $emailService;
    private PaymentService $paymentService;
    private PaymentGatewayServiceInterface $gatewayService;

    public function __construct(
        EmailService $emailService,
        PaymentService $paymentService,
        PaymentGatewayServiceInterface $gatewayService
    ){
        $this->emailService = $emailService;
        $this->paymentService = $paymentService;
        $this->gatewayService = $gatewayService;
    }

    public function process(array $customer, float $amount){
        $this->emailService->sendMessage();
        $this->paymentService->pay(444);
        $this->gatewayService->charge([1,2,3], 44, 55);
        var_dump($customer, $amount);
    }
}