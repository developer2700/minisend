<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmailUpdateTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_returns_the_updated_email_on_successfully_updating_the_email()
    {
        $email =factory(\App\Models\Email::class)->create();

        $data = [
            'email' => [
                'subject' => $email->subject,
                'recipient' => $email->recipient,
                'sender' => 'sender2@gmail.com',
            ]
        ];

        $response = $this->putJson("/api/emails/{$email->id}", $data, $this->headers);
        $response->assertStatus(200)
            ->assertJson([
                'email' => [
                    'sender' => 'sender2@gmail.com',
                ]
            ]);
    }

    /** @test */
    public function it_returns_appropriate_field_validation_errors_when_updating_the_email_with_invalid_inputs()
    {
        $email = factory(\App\Models\Email::class)->create();

        $data = [
            'email' => [
                'sender' => '',
            ]
        ];

        $response = $this->putJson("/api/emails/{$email->id}", $data, $this->headers);

        $response->assertStatus(422)
            ->assertJson([
                "message"=>"The given data was invalid.",
                'errors' => [
                    'sender' => ['The sender field is required.'],
                ]
            ]);
    }

    /** @test */
//    public function it_returns_an_unauthorized_error_when_trying_to_update_compny_without_logging_in()
//    {
//        $email = $this->loggedInUser->products()->save(factory(\App\Models\Email::class)->make());
//
//        $data = [
//            'email' => [
//                'sender' => 'new name',
//            ]
//        ];
//
//        $response = $this->putJson("/api/emails/{$email->id}", $data);
//
//        $response->assertStatus(401);
//    }


}
