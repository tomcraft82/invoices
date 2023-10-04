<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Entities;

class InvoiceProductLineEntity
{
    protected string $id;
    protected ProductEntity $product;
    protected int $quantity;

    public function __construct(string $id, array $productAttrs, int $quantity)
    {
        $this->id = $id;
        $this->product = new ProductEntity($productAttrs['id'], $productAttrs['name'], $productAttrs['price']);
        $this->quantity = $quantity;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'product' => $this->product->toArray(),
            'quantity' => $this->quantity,
        ];
    }
}
