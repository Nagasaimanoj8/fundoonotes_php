<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // protected static $token;
    // public static function setUpBeforeClass(): void
    // {
    //     self::$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY1MTQzMTM2MSwiZXhwIjoxNjUxNDM0OTYxLCJuYmYiOjE2NTE0MzEzNjEsImp0aSI6Im1TdmFzcXFTaTFnbXRvQXQiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.lURZ82AjfHMGTf9IJab2hQxeXgx5eSKGkwnYTl3PviY";
    // }
    public function successfulCreateNoteTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/addToNotes', [
                "title" => "Work",
                "description" => "lovely day of morning",
                
            ]);
        $response->assertStatus(200);

    }
    /**
     * UnSuccessful Create Note Test
     * Using Credentials Required and
     * using the authorization token
     * Wrong Credentials is used for this test
     * 
     * @test
     */
    public function unSuccessfulCreateNoteTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/addToNotes', [
                "title" => "Work",
                "description" => "lovely day of morning",
            ]);
        $response->assertStatus(400);
    }
    /**
     * Successful Update Note By ID Test
     * Update a note using id and authorization token
     * 
     * @test
     */
    public function successfulUpdateNoteByIdTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/updateNotes', [
                "userId" => "8",
                "title" => "samsung",
                "description"=>"Nice"
            ]);
        $response->assertStatus(200);
    }
    /**
     * UnSuccessful Update Note By ID Test
     * Update a note using id and authorization token
     * Passing wrong note or noteId which is not for this user, for this test
     * 
     * @test
     */
    public function unSuccessfulUpdateNoteByIdTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/updatenotebyid', [
                "userId" => "8",
                "title" => "Expence",
                "description" => "Write Down Your Expences",
            ]);
        $response->assertStatus(400);
    }
    /**
     * Successful Delete Note By ID Test
     * Delete note by using id and authorization token
     * 
     * @test
     */
    public function successfulDeleteNoteByIdTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/deletenotebyid', [
                "id" => "8",
            ]);
        $response->assertStatus(200);
    }
     /**
     * UnSuccessful Delete Note By ID Test
     * Delete note by using id and authorization token
     * Passing wrong note or noteId which is not for this user, for this test
     * 
     * @test
     */
    public function unSuccessfulDeleteNoteByIdTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/delete', [
                "id" => "80",
                
            ]);
        $response->assertStatus(40);
    }
     /**
     * Successful Add NoteLabel Test
     * Add NoteLabel using the label_id, note_id and authorization token
     * 
     * @test
     */
    public function successfulAddNoteLabelTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/addTolabel', [
                'label' => '3',
                'notes_id' => '5',
                
            ]);
        $response->assertStatus(200);
    }
     /**
     * UnSuccessful Add NoteLabel Test
     * Add NoteLabel using the label_id, note_id and authorization token
     * Using wrong label_id or note_id which is not of this user,
     * for this test
     * 
     * @test
     */
    public function unSuccessfulAddNoteLabelTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/addnotelabel', [
                'label_id' => '13',
                'note_id' => '81',
            ]);
        $response->assertStatus(400);
    }
    /**
     * Successful Delete NoteLabel Test
     * Delete NoteLabel using the label_id, note_id and authorization token
     * 
     * @test
     */
    public function successfulDeleteNoteLabelTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/delete', [
                'label_id' => '12',
                'note_id' => '81',
                
            ]);
        $response->assertStatus(200);
    }
     /**
     * UnSuccessful Delete NoteLabel Test
     * Delete NoteLabel using the label_id, note_id and authorization token
     * Using wrong label_id or note_id which is not of this user,
     * for this test
     * 
     * @test
     */
    public function unSuccessfulDeleteNoteLabelTest()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
        ])
            ->json('POST', '/api/delete', [
                'label_id' => '12',
                'note_id' => '81',
                
            ]);
        $response->assertStatus(400);
    }
}
