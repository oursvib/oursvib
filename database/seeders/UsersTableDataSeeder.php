<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <=4; $i++) {
            User::create([
                'name' => str_random(8),
                'email' => 'karthick.oursvib+'.$i.'@gmail.com',
                'password' => bcrypt('123456'),
                'role'=>$i
            ]);
        }
    }
}
