<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserContollerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /**
     * Successfull Registration
     * This test is to check user Registered Successfully or not
     * by using first_name, last_name, email and password as credentials
     * 
     * @test
     */
    public function successfulRegistrationTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/register', [
                "name" => "sai",
                "email" => "sai@gmail.com",
                "password" => "jonamiasagan@123",
            ]);
        $response->assertStatus(200);
    }
    /**
     * Test to check the user is already registered
     * by using first_name, last_name, email and password as credentials
     * The email used is a registered email for this test
     * 
     * @test
     */
    public function userisAlreadyRegisteredTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/register', [
                "name" => "sai",
                "email" => "sai@gmail.com",
                "password" => "jonamiasagan@123"
            ]);
        $response->assertStatus(401);
    }
     /**
     * Test for successful Login
     * Login the user by using the email and password as credentials
     * 
     * @test
     */
    public function successfulLoginTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
        ->json('POST', '/api/login',
            [
                "email" => "sai@gmail.com",
                "password" => "jonamiasagan@123"
            ]
        );
        $response->assertStatus(200);
    }
     /**
     * Test for Unsuccessfull Login
     * Login the user by email and password
     * Wrong password for this test
     * 
     * @test
     */
    public function unSuccessfulLoginTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
        ->json('POST', '/api/login',
            [
                "email" => "sai@gmail.com",
                "password" => "kumar12"
            ]
        );
        $response->assertStatus(402)->assertJson(['message' => 'Wrong Password']);
    }
}
