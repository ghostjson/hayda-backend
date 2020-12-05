<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $free = new Subscription();

        $free->name = "Free";
        $free->features = ["Health Information", "Resources", "Games", "Incentives", "Feedback", "Geolocation", "Machine Learning", "Alert Notification", "Email list", "Basic Chatbot", "Social Community"];
        $free->price = 0;
        $free->save();

        $premium = new Subscription();
        $premium->name = "Premium";
        $premium->features = ["Basic offering plus in-depth analysis", "Health Coach", "Video Chat By Appointment", "Chatbot On Demand", "Reminder Prompts", "Blogging", "Podcast"];
        $premium->price = 20;
        $premium->save();

        $premium_plus = new Subscription();
        $premium_plus->features = ["Basic offering plus in-depth analysis", "Health Coach", "Video Chat By Appointment", "Chatbot On Demand", "Reminder Prompts", "Blogging", "Podcast"];
        $premium_plus->name = "Premium Plus";
        $premium_plus->price = 50;
        $premium_plus->save();
    }
}
