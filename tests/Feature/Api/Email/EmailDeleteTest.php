<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmailDeleteTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_returns_a_200_success_response_on_successfully_removing_the_email()
    {
        $email = factory(\App\Models\Email::class)->create();

        $response = $this->deleteJson("/api/emails/{$email->id}", [], $this->headers);

        $response->assertStatus(200);

        $response = $this->getJson("/api/emails/{$email->id}");

        $response->assertStatus(404);
    }

}
