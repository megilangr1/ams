<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'MeGGi',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin123'),
            ]
        ];

        foreach ($data as $key => $value) {
            try {
                $createUser = User::create($value);
            } catch (\Exception $e) {
                // dd($e);
            }
        }
    }
}
