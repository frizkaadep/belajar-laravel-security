<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where("email", "frizka@localhost")->firstOrFail();

        $todo = new Todo();
        $todo->title = "Test Todo";
        $todo->description = "Test Todo Description";
        $todo->user_id = $user->id;
        $todo->save();
    }
}
