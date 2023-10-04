<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Entities;

use App\Modules\Invoices\Domain\ValueObjects\Price;

class ProductEntity
{
    protected string $id;
    protected string $name;
    protected Price $price;

    public function __construct(string $id, string $name, int $amount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = new Price($amount, 'usd');
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price->getAmount() . ' ' . $this->price->getCurrency(),
        ];
    }
}
