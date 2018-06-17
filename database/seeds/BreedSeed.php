<?php

use Illuminate\Database\Seeder;

class BreedSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'breed_title' => 'Affenpinscher'],
            ['id' => 2, 'breed_title' => 'Afghan Hound'],
            ['id' => 3, 'breed_title' => 'Airedale Terrier'],
            ['id' => 4, 'breed_title' => 'Akita'],
            ['id' => 5, 'breed_title' => 'Alaskan Klee Kai'],
            ['id' => 6, 'breed_title' => 'Alaskan Malamute'],
            ['id' => 7, 'breed_title' => 'American Bulldog'],

        ];

        foreach ($items as $item) {
            \App\Breed::create($item);
        }
    }
}
