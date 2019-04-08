<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Contacts::class, 50)->create()->each(function ($contact) {
            $contact->addresses()->save(factory(App\ContactAddresses::class)->make());
        });
    }
}
