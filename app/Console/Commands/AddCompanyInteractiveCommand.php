<?php

namespace App\Console\Commands;

use App\Company;
use Illuminate\Console\Command;

class AddCompanyInteractiveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:add-company-interactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a company asking for company info';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('What is the company name?');
        $phone = $this->ask('What is the company phone number?');

        if ($this->confirm('Do you want add ' . $name . ' company?'))
        {
            Company::create([
                'name' => $name ?? 'Anonymous company',
                'phone' => $phone ?? 'N/A'
            ]);

            return $this->info('Company ' . $name . ' added');
        }

        $this->warn('Company hasn\'t been added');
    }
}
