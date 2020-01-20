<?php

namespace Modules\Payment\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Payment\Entities\Transaction;

class PaymentTransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Bank Transaction
        Transaction::create([
            'user_id' => 1, 
            'payment_method' => 1, 
            'transaction_type' => 'income', 
            'transaction_amount' => 1000000, 
            'transaction_usage' => 'best_premium', 
            'bonus' => 0, 
            'current_amount' => 1000000, 
            'status' => 'pending'
        ]);
    }
}
