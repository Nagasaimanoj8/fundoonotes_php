<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LabelControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
     /**
     * Successful Create Label Test
     * Create a label using label_name and authorization token for a user
     * 
     * @test
     */
    public function successfulCreateLabelTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/addTolabel', [
                "label" => "Presentation",
                "notes_id"=>"3"
                
            ]);
        $response->assertStatus(200);
    }
     /**
     * UnSuccessful Create Label Test
     * Create a label using label_name and authorization token for a user
     * Using existing label name for this test
     * 
     * @test
     */
    public function unSuccessfulCreateLabelTest()
    {

        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/createlabel', [
                "labelname" => "Presentation",
              
            ]);
        $response->assertStatus(400);
    }

    /**
     * Successful Update Label Test
     * Update label using label_id, label_name and authorization
     * 
     * @test
     */
    public function successfulUpdateLabelTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/updateLabel', [
                'userId' => '6',
                'label' => 'Office Work',
                'notes_id'=>'12'
               
            ]);
        $response->assertStatus(200);
    }
    /**
     * UnSuccessful Update Label Test
     * Update label using label_id, label_name and authorization
     * Using existing label name for this test
     * 
     * @test
     */
    public function unSuccessfulUpdateLabelTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/updatelabel', [
                'id' => '14',
                'labelname' => 'Office Work',
                
            ]);
        $response->assertStatus(400);
    }

    /**
     * Successful Delete Label Test
     * Delete Label using label_id and authorization token
     * @test
     */
    public function successfulDeleteLabelTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/delete', [
                "userId" => "12",
               
            ]);
        $response->assertStatus(200);
    }

    /**
     * UnSuccessful Delete Label Test
     * Delete Label using label_id and authorization token
     * Giving wrong label_id for this test
     * 
     * @test
     */
    // public function unSuccessfulDeleteLabelTest()
    // {
    //     $response = $this->withHeaders([
    //         'Content-Type' => 'Application/json',
    //     ])
    //         ->json('POST', '/api/delete', [
    //             "userId" => "14",
                
    //         ]);
    //     $response->assertStatus(400);
    // }
}
