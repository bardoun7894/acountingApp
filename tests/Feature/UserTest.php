<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {

        // $user->save();
        $this->assertDatabaseHas('users', [
            'username' => 'superadmin',
        ]);
        // $this->assertDatabaseCount('users',0);

        // $response = $this->get('/');// Simulate a request as the created user
        // $response->assertStatus(200);
    }

   public  function testUser(){
        $userType = UserType::where('id',1)->first();
        $this->assertEquals("admin", $userType->user_type_en);
    }

    public function test_user_can_be_created_by_en()
    {
        $userType = UserType::where("id",1)->first();
        $this->assertEquals("admin", $userType->user_type_en);
        $this->assertEquals("", $userType->user_type_en );
    }


}
