<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CustomerImporterService;

class ImportCustomers extends Command
{

    public function __construct(private CustomerImporterService $importer)
    {
        parent::__construct();
        $this->importer = $importer;
    }


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
    public function handle()
    {
        $this->info('Importing customers...');

        try {
            $count = $this->importer->import();
            $this->info("Done! Imported or updated {$count} Australian customers.");
        } catch (\Throwable $e) {
            $this->error("Failed: " . $e->getMessage());
            return \Symfony\Component\Console\Command\Command::FAILURE;;
        }

        return \Symfony\Component\Console\Command\Command::SUCCESS;
    }
}
