<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'id',
        'number',
        'date',
        'due_date',
        'company_id',
        'status',
    ];

    public $timestamps = true;
    protected $keyType = 'string';

    public function invoiceLines()
    {
        return $this->hasMany(InvoiceProductLine::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
