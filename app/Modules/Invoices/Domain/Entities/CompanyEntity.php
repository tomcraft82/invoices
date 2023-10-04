<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Entities;

class CompanyEntity
{
    public function __construct(
        protected string $id,
        protected string $name,
        protected string $street,
        protected string $city,
        protected string $zip,
        protected string $phone,
        protected string $email,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'street' => $this->street,
            'city' => $this->city,
            'zip' => $this->zip,
            'phone' => $this->phone,
            'email' => $this->email,
        ];
    }
}
