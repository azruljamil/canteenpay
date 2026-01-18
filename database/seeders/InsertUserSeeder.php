<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InsertUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            [
                'name' => 'Hasziah Yazid',
                'email' => 'hasziah@matrade.gov.my',
                'password' => bcrypt('P@ssword12345'),
                'role' => 1,
            ],
            [
                'name' => 'Syed Zahirulddin',
                'email' => 'zahirul@matrade.gov.my',
                'password' => bcrypt('P@ssword12345'),
                'role' => 1,
            ],
            [
                'name' => 'Nor Azwa Md. Radzi',
                'email' => 'azwa@matrade.gov.my',
                'password' => bcrypt('P@ssword12345'),
                'role' => 1,
            ],
            [
                'name' => 'Nur Faiezah Sari',
                'email' => 'nurfaiezah@matrade.gov.my',
                'password' => bcrypt('P@ssword12345'),
                'role' => 1,
            ],
            [
                'name' => 'Shafinaz Riza',
                'email' => 'iza@matrade.gov.my',
                'password' => bcrypt('P@ssword12345'),
                'role' => 1,
            ],
            [
                'name' => 'Hanor Anis Najuwa',
                'email' => 'hanor@matrade.gov.my',
                'password' => bcrypt('P@ssword12345'),
                'role' => 1,
            ],
            [
                'name' => 'Putri Nursyuhada',
                'email' => 'putri@matrade.gov.my',
                'password' => bcrypt('P@ssword12345'),
                'role' => 1,
            ],
            [
                'name' => 'Noreen',
                'email' => 'noreencm@matrade.gov.my',
                'password' => bcrypt('P@ssword12345'),
                'role' => 1,
            ],
            [
                'name' => 'Asnor vidya',
                'email' => 'asnor@matrade.gov.my',
                'password' => bcrypt('P@ssword12345'),
                'role' => 1,
            ],
            [
                'name' => 'Juliana',
                'email' => 'juliana@matrade.gov.my',
                'password' => bcrypt('P@ssword12345'),
                'role' => 1,
            ],
            [
                'name' => 'Nazsoftech Admin',
                'email' => 'admin@digitvent.com',
                'password' => bcrypt('!nzst@2025'),
                'role' => 2,
            ]
        ]);
    }
}
