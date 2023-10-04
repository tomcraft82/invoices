<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'name',
        'price',
        'currency',
    ];

    public $timestamps = true;
    protected $keyType = 'string';
}
