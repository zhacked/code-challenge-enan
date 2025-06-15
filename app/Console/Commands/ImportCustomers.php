<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CustomerImporter;

class ImportCustomers extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customers:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import customers from the 3rd party API';

    /**
     * Execute the console command.
     */
    public function handle(CustomerImporter $importer)
    {
        $importer->importCustomers();
        $this->info('Customers imported successfully.');
    }
}
