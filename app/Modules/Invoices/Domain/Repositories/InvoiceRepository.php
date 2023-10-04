<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Repositories;

use App\Modules\Invoices\Domain\Aggregates\InvoiceAggregate;

interface InvoiceRepository
{
    public function getById(string $id): InvoiceAggregate;
    public function update(InvoiceAggregate $invoice): void;
}
