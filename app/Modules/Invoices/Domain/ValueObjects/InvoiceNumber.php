<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\ValueObjects;

use ErrorException;
use Ramsey\Uuid\Uuid;

class InvoiceNumber
{
    private string $value;

    public function __construct(string $value)
    {
        if (!Uuid::isValid($value)) {
            throw new ErrorException('Invoice number is not a valid UUID');
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
