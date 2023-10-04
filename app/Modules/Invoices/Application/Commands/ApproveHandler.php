<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\Commands;

use App\Modules\Approval\Api\Events\EntityApproved;
use App\Modules\Invoices\Domain\Repositories\InvoiceRepository;

class ApproveInvoiceHandler
{
    protected InvoiceRepository $invoiceRepo;

    public function __construct(InvoiceRepository $repository)
    {
        $this->invoiceRepo = $repository;
    }

    public function handle(EntityApproved $command)
    {
        $invoiceEntity = $this->invoiceRepo->getById($command->approvalDto->id->toString());

        if ($invoiceEntity->setStatus($command->approvalDto->status)) {
            $this->invoiceRepo->save($invoiceEntity);
        }
    }
}
