<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmailCreateTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_returns_the_email_on_successfully_creating_a_new_email()
    {
        $data = [
            'email' => [
                'sender' => 'from@gmail.com',
                'recipient' => 'to@gmail.com',
                'subject' => 'subject',
                'text' => 'some text',
            ]
        ];

        $response = $this->postJson('/api/emails', $data, $this->headers);
        $response->assertStatus(200)
            ->assertJson([
                'email' => [
                    'sender' => $data['email']['sender'],
                    'recipient' => $data['email']['recipient'],
                    'subject' => $data['email']['subject'],
                    'text' => $data['email']['text'],
                ]
            ]);
    }

    /** @test */
    public function it_returns_appropriate_field_validation_errors_when_creating_a_new_email_with_invalid_inputs()
    {
        $data = [
            'email' => [
                'sender' => '',
            ]
        ];

        $response = $this->postJson('/api/emails', $data, $this->headers);

        $response->assertStatus(422)
            ->assertJson([
                "message"=> "The given data was invalid.",
                'errors' => [
                    'sender' => ['The sender field is required.'],
                ]
            ]);
    }

    /** @test */
    public function it_returns_the_attachment_and_email_on_successfully_creating_a_new_email_with_attachment()
    {
        $email = factory(\App\Models\Email::class)->create();
        $data = [
            'email' => [
                'sender' => $email->sender,
                'recipient' => $email->recipient,
                'subject' => $email->subject,
                'text' => $email->text,
                'attachments' => [['filename'=>'file1.png']],
            ]
        ];
        $response = $this->postJson('/api/emails', $data, $this->headers);
        $response->assertStatus(200)
            ->assertJson($data);
    }

    // we won't use use login in this project
    /** @test */
//    public function it_returns_an_unauthorized_error_when_trying_to_add_email_without_logging_in()
//    {
//        $data = [
//            'email' => [
//                'sender' => 'email 1',
//            ]
//        ];
//
//        $response = $this->postJson('/api/emails', $data, []);
//
//        $response->assertStatus(401);
//    }
}
