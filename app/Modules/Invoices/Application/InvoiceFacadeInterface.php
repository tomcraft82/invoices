<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application;

interface InvoiceFacadeInterface
{
    public function show(string $number): InvoiceDto;
}
