<?php

namespace Tests\Feature;

use App\Models\Customers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomersControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_creation()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('customer', [
            'customer_name' => 'Abdullah',
            'phone' => '08123456789',
            'address' => 'Indonesia'
        ]);

        $response->assertRedirect('customer');
        $this->assertDatabaseHas('customers', [
            'customer_name' => 'Abdullah',
            'phone' => '08123456789',
            'address' => 'Indonesia'
        ]);
    }

    public function test_customer_update(){
        $user = User::factory()->create();
        $this->actingAs($user);

        $customer = Customers::factory()->create([
            'customer_name' => 'Ali',
            'phone' => '0811111111',
            'address' => 'Bekasi'
        ]);

        $response = $this->put("customer/{$customer->id}", [
            'customer_name' => 'tes',
            'phone' => '0811111222',
            'address' => 'Indonesia'
        ]);

        $response->assertRedirect('customer');
        $this->assertDatabaseHas('customers', [
            'customer_name' => 'tes',
            'phone' => '0811111222',
            'address' => 'Indonesia'
        ]);
    }

    public function test_customer_deletion(){
        $user = User::factory()->create();
        $this->actingAs($user);

        $customer = Customers::factory()->create([
            'customer_name' => 'Agung',
            'phone' => '0811111222',
            'address' => 'Grogol'
        ]);

        $response = $this->delete("customer/{$customer->id}", [
            'customer_name' => 'Agung',
            'phone' => '0811111222',
            'address' => 'Grogol'
        ]);

        $response->assertRedirect('customer');
        $this->assertDatabaseHas('customers', [
            'customer_name' => 'Agung',
            'phone' => '0811111222',
            'address' => 'Grogol'
        ]);
    }

    // public function test_customer_name_must_be_required()
    // {
    //     $user = User::factory()->create();
    //     $this->actingAs($user);

        // Customers::factory()->create([
        //     'customer_name' => 'Test',
        //     'phone' => '08123456111',
        //     'address' => 'Indonesia'
        // ]);
        
        // $response = $this->post('customer', [
        //     'customer_name' => null,
        //     'phone' => '08123456111',
        //     'address' => 'Indonesia'
        // ]);
        // $response->assertRedirect('customer');
        // print_r($response->getContent()); 
        // die;
        // $response->assertSessionHasErrors([
            // 'customer_name' => 'Customer name is required'
        // ]);

        //   $response->assertStatus(302);
    // }
}

?>