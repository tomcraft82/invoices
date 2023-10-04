<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\ValueObjects;

class Price
{
    private int $amount;
    private string $currency;

    public function __construct(int $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function isEqual(Currency $compared): bool
    {
        return $this->currency === $compared->currency && $this->amount === $compared->amount;
    }
}
