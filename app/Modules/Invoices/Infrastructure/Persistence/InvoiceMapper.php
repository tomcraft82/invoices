<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Persistence;

use App\Modules\Invoices\Application\Models\Invoice;
use App\Modules\Invoices\Domain\Aggregates\InvoiceAggregate;

class InvoiceMapper
{
    public static function createAggregateFromModel(Invoice $invoiceModel): InvoiceAggregate
    {
        return new InvoiceAggregate($invoiceModel->getAttributes(), $invoiceModel->invoiceLines, $invoiceModel->company->getAttributes());
    }

    public static function createModelFromAggregate(InvoiceAggregate $invoiceAggregate): Invoice
    {
        return new Invoice($invoiceAggregate->toArray());
    }
}
