<?php

namespace Template\Php\Controllers;

use Template\Php\Services\EmailService;
use Template\Php\Services\InvoiceService;
use Template\Php\View;

class Invoice
{
    private InvoiceService $invoiceService;
    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index(): View
    {
        //unset($_SESSION['count']);
        //return "Index Invoices";

        $this->invoiceService->process(["algo"], 23);

        return View::make('invoices/index', ['foo' => 'barrrrr']);
    }

    public function create(): string
    {
        return '<form action="/invoices/create" method="post"><label>Amount</label><input type="text" id="amount" name="amount" required minlength="4" maxlength="8" size="10" /></form>';
    }

    public function store()
    {
        var_dump($_POST['amount']);
    }

}