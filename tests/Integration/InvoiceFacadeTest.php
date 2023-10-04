<?php

namespace Tests\Integration;

use App\Modules\Invoices\Application\InvoiceFacade;
use App\Modules\Invoices\Infrastructure\Database\Seeders\DatabaseSeeder;
use App\Modules\Invoices\Infrastructure\Persistence\InvoiceRepositoryEloquent;
use Illuminate\Support\Facades\DB;

class InvoiceFacadeTest extends TestCase
{
    public function testShow()
    {
        $this->seed(DatabaseSeeder::class);

        $repository = new InvoiceRepositoryEloquent();
        $facade = new InvoiceFacade($repository);
        $invoiceModelSeeded = DB::table('invoices')->first();

        $invoiceDto = $facade->show($invoiceModelSeeded->id);

        $this->assertEquals($invoiceModelSeeded->number, $invoiceDto->number);
    }
}
