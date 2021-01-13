<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmailFilterTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_returns_an_empty_array_of_emails_when_no_emails_exist_with_the_sender()
    {
        $response = $this->getJson('/api/emails?sender=test');

        $response->assertStatus(200)
            ->assertJson([
                'emails' => [],
                'emailsCount' => 0
            ]);

    }

    /** @test */
    public function it_returns_array_of_emails_when_emails_exist_by_given_sender()
    {
        $emails = factory(\App\Models\Email::class)->times(3)->create(['sender' => 'email1']);

        $response = $this->getJson('/api/emails?sender=email1');

        $response->assertStatus(200)
            ->assertJson([
                'emails' => [
                    [
                        'id' => $emails[2]->id,
                        'sender' => $emails[2]->sender,
                    ],
                    [
                        'id' => $emails[1]->id,
                        'sender' => $emails[1]->sender,
                    ],
                    [
                        'id' => $emails[0]->id,
                        'sender' => $emails[0]->sender,
                    ],
                ],
                'emailsCount' => 3
            ]);
    }

    /** @test */
    public function it_returns_array_of_emails_when_emails_exist_by_given_id()
    {
        $emails = factory(\App\Models\Email::class)->times(3)->create(['sender' => 'email1']);

        $response = $this->getJson('/api/emails?id=1');

        $response->assertStatus(200)
            ->assertJson([
                'emails' => [
                    [
                        'sender' => $emails[2]->sender,
                    ],
                ],
                'emailsCount' => 1
            ]);
    }




}
