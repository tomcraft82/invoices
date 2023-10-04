<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application;

use App\Domain\Enums\StatusEnum;
use Carbon\CarbonImmutable;

final readonly class InvoiceDto
{
    public string $id;
    public string $number;
    public CarbonImmutable $date;
    public CarbonImmutable $dueDate;
    public StatusEnum $status;
    public array $company;
    public array $invoiceLines;

    public function __construct(array $invoiceAttrs)
    {
        foreach ($invoiceAttrs as $key => $value) {
            $this->$key = $value;
        }
    }
}
