<?php

use App\Company;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('custom:clean-unused-company', function (){
    $this->info('Cleaning unused companies...');
    Company::whereDoesntHave('customers')
        ->get()
        ->each(function ($company) {
            $company->delete();
            $this->warn($company->name . ' deleted!');
        });
})->describe('Cleans unused companies');
