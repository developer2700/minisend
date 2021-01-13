<?php

use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Populate the database with dummy data for testing.
     * Complete dummy data generation including relationships.
     *
     * @param \Faker\Generator $faker
     */
    public function run(\Faker\Generator $faker)
    {
        // create some headquarters email
        factory(\App\Models\Email::class)->times(10)->create();

        // create some attachments
        factory(\App\Models\Attachment::class, 60)->state('with-email')->create();

    }
}
