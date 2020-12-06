<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        setSettings('stripe_publishable_key', 'pk_test_51HvJkCLtTrjFBbiiIrRYfwtFtpQraZePfjqYSDO1lG6wIoOEpK0lyoGuACnmSkFNjiuSjQJ7YvxXWcpukntPOret00qYtKK349');
        setSettings('stripe_secret_key', 'sk_test_51HvJkCLtTrjFBbii2UUNq9c2oI7VgEqmWhf1AQcxzoqrJybFIpt6i2uVmta52xTYK1eEqmTNLexf91RWMCIoVu9S00m45gO3RX');
    }
}
