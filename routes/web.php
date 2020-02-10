<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});*/

// Alternative syntax for view routing
Route::view('/', 'home');
Route::view('about', 'about');
//Route::view('contact', 'contact');
//Route::view('dummypage', 'dummypage');

// Passing data to view
/*Route::get('customers', function () {
    $customers = [
      'John Doe',
      'Jane Doe',
      'Bob the builder'
    ];

    return view('internals.customers', [
        'customerList' => $customers
    ]);
});*/

// Using a RESTful controller
Route::get('customers', 'CustomersController@index');
Route::get('customers/create', 'CustomersController@create');
Route::post('customers', 'CustomersController@store');
// Using middleware to authorize customer detail view access
Route::get('customers/{customer}', 'CustomersController@show')->middleware('can:view,customer');
//Route::get('customers/{customer}', 'CustomersController@show');
Route::get('customers/{customer}/edit', 'CustomersController@edit');
Route::patch('customers/{customer}', 'CustomersController@update');
Route::delete('customers/{customer}', 'CustomersController@destroy');

// Using resourceful route with authorization restriction
//Route::resource('customers', 'CustomersController');

// Using authenticate middleware in order to restrict access of customers section
//Route::resource('customers', 'CustomersController')->middleware('auth');
// Using custom middleware array
//Route::view('about', 'about')->middleware(['custom', 'nextCustom']);

// Contact form routes
Route::get('contact', 'ContactFormController@create');
Route::post('contact', 'ContactFormController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
