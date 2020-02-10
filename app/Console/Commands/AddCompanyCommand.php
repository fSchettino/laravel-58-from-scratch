<?php

namespace App\Console\Commands;

use App\Company;
use Illuminate\Console\Command;

class AddCompanyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // Optional arguments are identified by a question mark following the argument.
    // We can assign a default value to argument through {argument-name = argument-value}.
    protected $signature = 'custom:add-company {name} {phone=N/A}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a company';

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
        $company = Company::create([
            'name' => $this->argument('name'),
            'phone' => $this->argument('phone')
        ]);

        $this->info('New company added: '. $company->name);
        $this->warn('You\'ve added a company through a command');
        $this->error('This is an example error message');
    }
}
