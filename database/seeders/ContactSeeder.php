<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where("email", "frizka@localhost")->firstOrFail();

        $contact = new Contact();
        $contact->name = "frizka Contact";
        $contact->email = "frizka@localhost";
        $contact->user_id = $user->id;
        $contact->save();
    }
}
