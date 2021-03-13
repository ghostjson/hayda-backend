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
        setSettings('web_app_url', 'http://localhost:8080');
        setSettings('admin_panel_url', 'http://localhost:8081');
        setSettings('theme', json_encode(
            [
                'primary_color' => '#ee2425',
                'secondary_color' => '#0e1d53'
            ]
        ));

        setSettings('website_contact_email', 'example@example.com');
        setSettings('app_urls', json_encode([
            'android' => '#',
            'ios' => '#'
        ]));
    }
}
