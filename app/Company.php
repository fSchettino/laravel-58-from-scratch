<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //protected $fillable = ['name', 'phone'];
    protected $guarded = [];

    // One to many relationship: A company has many customers
    public function customers() {
        return $this->hasMany(Customer::class);
    }
}
