<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmailViewTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_returns_the_email_by_id_if_valid_and_not_found_error_if_invalid()
    {
        $email = factory(\App\Models\Email::class)->create();

        $response = $this->getJson("/api/emails/{$email->id}");

        $response->assertStatus(200)
            ->assertJson([
                'email' => [
                    'sender' => $email->sender,
                    'recipient' => $email->recipient,
                    'subject' => $email->subject,
                    'text' => $email->text,
                    'created_at' => $email->created_at,
                ]
            ]);

        $response = $this->getJson('/api/emails/wrong_id');

        $response->assertStatus(404);
    }

}
