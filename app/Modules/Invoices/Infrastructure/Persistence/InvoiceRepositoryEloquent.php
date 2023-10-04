<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Infrastructure\Persistence;

use App\Modules\Invoices\Application\Models\Invoice;
use App\Modules\Invoices\Domain\Aggregates\InvoiceAggregate;
use App\Modules\Invoices\Domain\Repositories\InvoiceRepository;

class InvoiceRepositoryEloquent implements InvoiceRepository
{
    public function getById(string $id): InvoiceAggregate
    {
        $invoiceModel = Invoice::findOrFail($id);

        return InvoiceMapper::createAggregateFromModel($invoiceModel);
    }

    public function update(InvoiceAggregate $invoiceAggregate): void
    {
        $invoiceModel = InvoiceMapper::createModelFromAggregate($invoiceAggregate);

        $invoiceModel->save();
    }
}
