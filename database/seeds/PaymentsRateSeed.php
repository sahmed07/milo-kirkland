<?php

use Illuminate\Database\Seeder;

class PaymentsRateSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'payment_type' => 'License Fees', 'amount' => 30],
            ['id' => 2, 'payment_type' => 'Lost tag', 'amount' => 10],
            ['id' => 3, 'payment_type' => 'Fine', 'amount' => 50],
            ['id' => 4, 'payment_type' => 'Impound', 'amount' => 5],
            ['id' => 5, 'payment_type' => 'Discount', 'amount' => 10],

        ];

        foreach ($items as $item) {
            \App\PaymentsRate::create($item);
        }
    }
}
