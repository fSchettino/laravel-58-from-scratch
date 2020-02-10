<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        // Generate a company and automatically assign company id to company_id key
        //'company_id' => factory(\App\Company::class)->create(),
        'company_id' => rand(1, 10),
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'active' => rand(0, 1)
    ];
});
