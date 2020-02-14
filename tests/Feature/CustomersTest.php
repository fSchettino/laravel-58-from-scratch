<?php

namespace Tests\Feature;

use App\Customer;
use App\User;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomersTest extends TestCase
{
    use RefreshDatabase;

    // Perform actions before execute tests
    protected function setUp(): void
    {
        parent::setUp();

        // Substitute the Event class with a fake dummy class
        // Ensure no events will be fired (in this case the NewCustomerHasRegisteredEvent event instanced in the controller)
        Event::fake();
    }

    // Perform actions after execute tests
    protected function tearDown(): void
    {
        parent::tearDown();
        dump('Test executed!!');
    }

    // Using /** @test */ before method we can assign any name to test method
    /** @test */
    public function OnlyLoggedInUsersCanSeeTheCustomersList()
    {
        $response = $this->get('/customers')
            ->assertRedirect('/login');
    }

    // If we don't use /** @test */ our test method name must begin with test word
    public function testAuthenticatedUsersCanSeeTheCustomersList() {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get('/customers')->assertOk();
    }

    /** @test */
    public function aCustomerCanBeAddedThroughForm() {

        // Tells laravel do not handle exceptions and show the full stacktrace
        $this->withoutExceptionHandling();

        $this->actingAsAdmin();

        $response = $this->post('/customers', $this->data());

        $this->assertCount(1, Customer::all());
    }

    /** @test */
    public function aNameIsRequired() {

        $this->actingAsAdmin();

        // Passing a second array to array_merge with keys which have the same name of the first array,
        // first array key/value pairs will be overwritten by second ones
        $response = $this->post('/customers', array_merge($this->data(), ['name' => '']));

        $response->assertSessionHasErrors('name');

        $this->assertCount(0, Customer::all());
    }

    /** @test */
    public function aNameIsAtLeastThreeCharacters() {

        $this->actingAsAdmin();

        $response = $this->post('/customers', array_merge($this->data(), ['name' => 'ab']));

        $response->assertSessionHasErrors('name');

        $this->assertCount(0, Customer::all());
    }

    /** @test */
    public function anEmailIsRequired() {

        $this->actingAsAdmin();

        $response = $this->post('/customers', array_merge($this->data(), ['email' => '']));

        $response->assertSessionHasErrors('email');

        $this->assertCount(0, Customer::all());
    }

    /** @test */
    public function anEmailHasValidFormat() {

        $this->actingAsAdmin();

        $response = $this->post('/customers', array_merge($this->data(), ['email' => 'email.com']));

        $response->assertSessionHasErrors('email');

        $this->assertCount(0, Customer::all());
    }

    // Data object used by tests
    private function data() {
        return [
            'name' => 'Test Name',
            'email' => 'testemail@email.com',
            'active' => 1,
            'company_id' => 1
        ];
    }

    // Extracted method
    private function actingAsAdmin()
    {
        $user = factory(User::class)->create([
            'email' => 'admin@example.net'
        ]);

        $this->actingAs($user);
    }

}
