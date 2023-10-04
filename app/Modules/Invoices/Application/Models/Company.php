<?php

declare(strict_types=1);

namespace App\Modules\Invoices\Application\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = true;
    protected $keyType = 'string';
}
