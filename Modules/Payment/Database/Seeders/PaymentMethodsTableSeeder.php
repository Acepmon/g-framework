<?php

namespace Modules\Payment\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Payment\Entities\PaymentMethod;

class PaymentMethodsTableSeeder extends Seeder
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
        PaymentMethod::create([
            'code' => 'transaction',
            'name' => 'Bank Transaction',
            'data' => json_encode([
                    'bankName' => 'Хаан Банк',
                    'accountNo' => '00000000',
                    'accountName' => 'Example',
                    'accountCurrency' => 'MNT'
            ]),
            'enabled' => true
        ]);
        PaymentMethod::create([
            'code' => 'transaction',
            'name' => 'Bank Transaction',
            'data' => json_encode([
                    'bankName' => 'Хас Банк',
                    'accountNo' => '00000000',
                    'accountName' => 'Example',
                    'accountCurrency' => 'MNT'
            ]),
            'enabled' => true
        ]);

        PaymentMethod::create([
            'code' => 'transaction',
            'name' => 'Bank Transaction',
            'data' => json_encode([
                    'bankName' => 'Худалдаа Хөгжлийн Банк',
                    'accountNo' => '00000000',
                    'accountName' => 'Example',
                    'accountCurrency' => 'MNT'
            ]),
            'enabled' => true
        ]);

        PaymentMethod::create([
            'code' => 'transaction',
            'name' => 'Bank Transaction',
            'data' => json_encode([
                    'bankName' => 'Төрийн Банк',
                    'accountNo' => '00000000',
                    'accountName' => 'Example',
                    'accountCurrency' => 'MNT'
            ]),
            'enabled' => true
        ]);

        // Card Local
        PaymentMethod::create([
            'code' => 'card-khanbank',
            'name' => 'Khanbank Card',
            'data' => null,
            'enabled' => false
        ]);

        // Social Pay
        PaymentMethod::create([
            'code' => 'socialpay',
            'name' => 'Social Pay',
            'data' => null,
            'enabled' => false
        ]);
        
        // Most Money
        PaymentMethod::create([
            'code' => 'mostmoney',
            'name' => 'Most Money',
            'data' => null,
            'enabled' => false
        ]);

        // Lendmn
        PaymentMethod::create([
            'code' => 'lendmn',
            'name' => 'Lend MN',
            'data' => null,
            'enabled' => false
        ]);

        // Credit/Debit Card
        PaymentMethod::create([
            'code' => 'card-credit',
            'name' => 'Credit/Debit Card',
            'data' => null,
            'enabled' => false
        ]);
    }
}
