<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmailPaginateTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_returns_the_correct_emails_with_limit_and_offset()
    {

        $emails = factory(\App\Models\Email::class)->times(25)->create();

        $response = $this->getJson('/api/emails');

        $response->assertStatus(200)
            ->assertJson([
                'emailsCount' => 25
            ]);

        $this->assertCount(20, $response->json()['emails'], 'Expected emails to set default limit to 20');

        $this->assertEquals(
            \App\Models\Email::latest()->take(20)->pluck('subject')->toArray(),
            array_column($response->json()['emails'], 'subject'),
            'Expected latest 20 emails by default'
        );

        $response = $this->getJson('/api/emails?limit=10&offset=5');

        $response->assertStatus(200)
            ->assertJson([
                'emailsCount' => 25
            ]);

        $this->assertCount(10, $response->json()['emails'], 'Expected emails limit of 10 when set');

        $this->assertEquals(
            \App\Models\Email::latest()->skip(5)->take(10)->pluck('subject')->toArray(),
            array_column($response->json()['emails'], 'subject'),
            'Expected latest 10 emails with 5 offset'
        );
    }
}
