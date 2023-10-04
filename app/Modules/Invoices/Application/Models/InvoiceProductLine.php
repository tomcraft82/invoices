<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceProductLine extends Model
{
    protected $fillable = [
        'id',
        'invoice_id',
        'product_id',
        'quantity',
    ];

    public $timestamps = true;
    protected $keyType = 'string';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
