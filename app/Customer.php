<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // 1ª Method for mass assignment
    // Define what are the attributes which can be passed to the model through mass assignment
    // $fillable array must include all attributes passed through mass assignment.
    //protected $fillable = ['name', 'email', 'active'];

    // 2ª Method for mass assignment
    // The $guarded array indicates what attributes are excluded from mass assignment.
    // Defining a $guarded empty array implies that all data passed to the model are allowed for mass assignment.
    // $guarded is the opposite of $fillable and is used when the usage of validation and mass assignment best practice
    // is applied in the controller.
    protected $guarded = [];

    // Set default value for model attributes listed in $attributes array
    protected $attributes = [
        'active' => '1'
    ];

    // Accessor method is a way to access data coming from database and handle them before they get send to view.
    // We can map model attributes within a key/value array and send meaningful data to the view.
    // Accessor method has naming convention, each accessor method must be named with "get" + "Column name" + "Attribute".
    public function getActiveAttribute($attribute){
        return $this->activeOptions()[$attribute];
    }

    // Scope method has naming convention, each scope method must be named with "scope" + "Name".
    public function scopeActive($query) {
        return $query->where('active', 1);
    }

    public function scopeInactive($query) {
        return $query->where('active', 0);
    }

    // One to one relationship: A customer belongs to a company
    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function activeOptions() {
        return [
            '1' => 'Active',
            '0' => 'Inactive',
            '2' => 'In-progress'
        ];
    }
}
