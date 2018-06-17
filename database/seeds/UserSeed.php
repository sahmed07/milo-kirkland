<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$m.UUoZ6c84PUrzmamolOC./96CuLUgR2eHJsRI24r/Nsd94HaTWyy', 'remember_token' => '', 'city_id' => 1],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
