<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\Commands;

use App\Modules\Approval\Api\Events\EntityRejected;
use App\Modules\Invoices\Domain\Repositories\InvoiceRepository;

class RejectInvoiceHandler
{
    protected InvoiceRepository $invoiceRepo;

    public function __construct(InvoiceRepository $repository)
    {
        $this->invoiceRepo = $repository;
    }

    public function handle(EntityRejected $command)
    {
        $invoiceEntity = $this->invoiceRepo->getById($command->approvalDto->id->toString());

        if ($invoiceEntity->setStatus($command->approvalDto->status)) {
            $this->invoiceRepo->save($invoiceEntity);
        }
    }
}
