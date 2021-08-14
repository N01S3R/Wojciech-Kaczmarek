<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rank;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'rank' => Rank::where('name', '=', 'Użytkownik')->first()->id,
            'uuid' => Str::uuid()
        ]);

        User::create([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'rank' => Rank::where('name', '=', 'Użytkownik')->first()->id,
            'uuid' => Str::uuid()
        ]);

        User::create([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'rank' => Rank::where('name', '=', 'Użytkownik')->first()->id,
            'uuid' => Str::uuid()
        ]);

        User::create([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'rank' => Rank::where('name', '=', 'Użytkownik')->first()->id,
            'uuid' => Str::uuid()
        ]);

        User::create([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'rank' => Rank::where('name', '=', 'Użytkownik')->first()->id,
            'uuid' => Str::uuid()
        ]);

        User::create([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            'rank' => Rank::where('name', '=', 'Administrator')->first()->id,
            'uuid' => Str::uuid()
        ]);
    }

}