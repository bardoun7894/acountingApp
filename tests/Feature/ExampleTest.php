<?php

namespace Tests\Feature;
 
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    // public function test_example()
    // {

    //    return $this->testCustomerInvoiceRemainingAmount();

    // }
    public function testCustomerInvoiceRemainingAmount()
{
    // Arrange: create a customer invoice or use a seeded one
    $id = 8; // replace with a valid invoice ID

    // Act: make a GET request to the route (adjust the route as per your application)
    $response = $this->get("/paid_customer_amount/{id}");

    // Assert: Check the response status and content
    // $response->assertStatus(200);
    $response->assertJson([
        'remaining_amount' => ""
    ]);
}


}
