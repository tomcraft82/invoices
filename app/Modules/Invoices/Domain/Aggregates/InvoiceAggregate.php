<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Domain\Aggregates;

use App\Domain\Enums\StatusEnum;
use App\Modules\Invoices\Application\InvoiceDto;
use App\Modules\Invoices\Domain\Entities\CompanyEntity;
use App\Modules\Invoices\Domain\Entities\InvoiceProductLineEntity;
use App\Modules\Invoices\Domain\ValueObjects\InvoiceNumber;
use App\Modules\Invoices\Domain\ValueObjects\Price;
use Illuminate\Support\Collection;
use Carbon\CarbonImmutable;

class InvoiceAggregate
{
    protected string $id;
    protected InvoiceNumber $number;
    protected CarbonImmutable $date;
    protected CarbonImmutable $dueDate;
    protected CompanyEntity $company;
    protected StatusEnum $status;
    protected Collection $invoiceLines;

    public function __construct(
        array $modelAttrs,
        Collection $invoiceLines,
        array $companyAttrs
    ) {
        $this->id = $modelAttrs['id'];
        $this->number = new InvoiceNumber($modelAttrs['number']);
        $this->date = new CarbonImmutable($modelAttrs['date']);
        $this->dueDate = new CarbonImmutable($modelAttrs['due_date']);
        $this->company = new CompanyEntity(
            $companyAttrs['id'],
            $companyAttrs['name'],
            $companyAttrs['street'],
            $companyAttrs['city'],
            $companyAttrs['zip'],
            $companyAttrs['phone'],
            $companyAttrs['email'],
        );
        $this->status = StatusEnum::from($modelAttrs['status']);

        $this->invoiceLines = $invoiceLines->map(function ($invoiceLine) {
            return new InvoiceProductLineEntity($invoiceLine->id, $invoiceLine->product->toArray(), $invoiceLine->quantity);
        });
    }

    public function getNumber(): InvoiceNumber
    {
        return $this->number;
    }

    public function setStatus(StatusEnum $status): bool
    {
        if ($this->status === StatusEnum::APPROVED || $this->status === StatusEnum::REJECTED) {
            return false;
        }

        $this->status = $status;

        return true;
    }

    public function getTotal(): Price
    {
        $total = $this->invoiceLines->reduce(function ($carry, $line) {
            return $carry + $line->product->price->getAmount();
        }, 0);

        return new Price($total, 'usd');
    }

    public function asDto(): InvoiceDto
    {
        $invoiceLines = $this->invoiceLines->map(function ($invoiceLineEntity) {
            return $invoiceLineEntity->toArray();
        });

        return new InvoiceDto([
            'id' => $this->id,
            'number' => $this->number->getValue(),
            'date' => $this->date,
            'dueDate' => $this->dueDate,
            'status' => $this->status,
            'company' => $this->company->toArray(),
            'invoiceLines' => $invoiceLines->toArray(),
        ]);
    }
}
