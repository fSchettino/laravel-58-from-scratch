<?php

namespace App\Http\Controllers;

use App\Company;
use App\Customer;
use App\Events\NewCustomerHasRegisteredEvent;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CustomersController extends Controller
{
    public function __construct()
    {
        // Using authenticate middleware in order to restrict access to index customers method (Customer list)
        $this->middleware('auth')->except(['index']);
        //$this->middleware('auth')->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    }

    public function index() {

        // Get all customers.
        //$customers = Customer::all();

        // Get active and inactive customers.
        //$activeCustomers = Customer::where('active', 1)->get();
        //$inactiveCustomers = Customer::where('active', 0)->get();

        /*return view('internals.customers', [
            //'customersList' => $customers
            'activeCustomersList' => $activeCustomers,
            'inactiveCustomersList' => $inactiveCustomers
        ]);*/

        // Fetching data using model scope methods which results in more readable, and clean code.
        //$activeCustomersList = Customer::active()->get();
        //$inactiveCustomersList = Customer::inactive()->get();

        // Lazy loading
        //$customers = Customer::all();

        // Eager loading
        //$customers = Customer::with('company')->get();

        // Eager loading + pagination
        $customers = Customer::with('company')->paginate(15);

        // Alternative way for sending variables to view, using compact.
        // In order to use compact, fetched data variables must have same name as variables passed to view
        return view('customers.index', compact('customers'));
    }

    public function create() {

        $companiesList = Company::all();

        // Due that we use the same form partial (form.blade.php) either for create than edit, and in the form we call
        // customer attributes, we need to pass a customer to our form to avoid app blow up when create a new customer.
        // For this reason we crete an empty customer model and pass it to view with company list.
        $customer = new Customer();

        return view('customers.create', compact('companiesList', 'customer'));
    }

    public function store() {

        // Checking user authorization policy
        // Check if user which is performing the request is authorized based on defined policies
        $this->authorize('create', Customer::class);

        // Meticulous assignment (data are assigned one by one) and then saved.
        /*$customer = new Customer();
        $customer->name = request('name');
        $customer->email = request('email');
        $customer->active = request('active');
        $customer->save();*/

        // Alternative way for create a new user,
        // We pass a validated data array to model.
        // This is also known as "mass assignment" which differ from meticulous assignment due we pass a chunk of
        // data (the array returned by validateRequest method) instead of one by one.
        // Combining validation and mass assignment results in more readable, secure and clean code.
        $customer = Customer::create($this->validateRequest());

        $this->storeImage($customer);

        // When a new customer is created an event is fired
        // The event receives the created model which has been stored in the $customer variable
        event(new NewCustomerHasRegisteredEvent($customer));

        return redirect('customers');
    }

    // If our function attribute has the exact same name as our route variable ({customer}) we can use route model binding.
    // Using route model binding we no need to fetch data at all, Laravel will fetch data for us behind the scene.
    public function show(Customer $customer /*Using route model binding - (Model name + route variable name) as attribute*/) {

        //$customer = Customer::find($customer);

        // Using firstOrFail method.
        // firstOrFail method search for given customer and if it's not found respond with 404 not found
        //$customer = Customer::where('id', $customer)->firstOrFail();

        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer) {

        $companiesList = Company::all();

        return view('customers.edit', compact('customer', 'companiesList'));
    }

    public function update(Customer $customer) {

        $customer->update($this->validateRequest());

        $this->storeImage($customer);

        return redirect('customers/' . $customer->id);
    }

    public function destroy(Customer $customer) {

        $this->authorize('delete', $customer);

        $customer->delete();

        return redirect('customers');
    }

    public function validateRequest() {

        // Validate request using base controller class ValidatesRequests trait.
        // IMPORTANT!!! Creating a data validated array using a request()->validate() method ensure that only the fields
        // listed in the request()->validate() method will be passed to our model for save purpose, despite of what and
        // how many fields are submitted to the server.
        // This practice avoid that potentially malicious data submitted by user within the request will be processed.

        /*return request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'active' => 'required',
            'company_id' => 'required',
        ]);*/

        /*// Validating optional field technique 1
        $validatedData = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'active' => 'required',
            'company_id' => 'required',
        ]);

        // Optional field is validated if its value is sended within the request
        if (request()->hasFile('image')) {
            request()->validate([
               'image' => 'file|image|max:5000'
            ]);
        }

        return $validatedData;*/

        /*// Validating optional field technique 2 (tap method)
        return tap(request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'active' => 'required',
            'company_id' => 'required',
        ]), function () {
            if (request()->hasFile('image')) {
                request()->validate([
                    'image' => 'file|image|max:5000'
                ]);
            }
        });*/

        // Validating optional field technique 3 (sometimes validation)
        return request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'active' => 'required',
            'company_id' => 'required',
            'image' => 'sometimes|file|image|max:5000'
        ]);
    }

    private function storeImage($customer)
    {
        if (request()->hasFile('image')){
            $customer->update([
                // Image request attribute is an instance of UploadedFile class and has access to all his methods
                // In this case store method is invoked on image uploaded file.
                'image' => request()->image->store('uploads', 'public')
            ]);

            // Manipulate image before upload with intervention/image imported library (composer require intervention/image).
            // Check http://image.intervention.io/ for API details and available methods
            // Using library through Image Facade
            $image = Image::make(public_path('storage/' . $customer->image))->fit(300, 1000);

            // save method with no parameter overwrite original image (if exists)
            // Adding parameter between parenthesis allow save image to a different place. Something like save as action
            $image->save();
        }
    }
}
