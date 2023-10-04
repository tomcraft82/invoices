<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application;

use App\Modules\Invoices\Application\InvoiceFacadeInterface;
use App\Modules\Invoices\Domain\Repositories\InvoiceRepository;

final readonly class InvoiceFacade implements InvoiceFacadeInterface
{
    protected InvoiceRepository $invoiceRepo;

    public function __construct(InvoiceRepository $repo)
    {
        $this->invoiceRepo = $repo;
    }

    public function show(string $id): InvoiceDto
    {
        $invoiceAggr = $this->invoiceRepo->getById($id);

        return $invoiceAggr->asDto();
    }
}
