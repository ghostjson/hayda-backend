<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Modules\StripeTrait;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    use StripeTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->stripe_init();

        $this->deactivateProducts();

        $free = new Subscription();

        $free->name = "Free";
        $free->features = json_encode(["Health Information", "Resources", "Games", "Incentives", "Feedback", "Geolocation", "Machine Learning", "Alert Notification", "Email list", "Basic Chatbot", "Social Community"]);
        $free->price = 0;


        $premium = new Subscription();
        $premium->name = "Premium";
        $premium->features = json_encode(["Basic offering plus in-depth analysis", "Health Coach", "Video Chat By Appointment", "Chatbot On Demand", "Reminder Prompts", "Blogging", "Podcast"]);
        $premium->price = 20;

        $premium_plus = new Subscription();
        $premium_plus->features = json_encode(["Basic offering plus in-depth analysis", "Health Coach", "Video Chat By Appointment", "Chatbot On Demand", "Reminder Prompts", "Blogging", "Podcast"]);
        $premium_plus->name = "Premium Plus";
        $premium_plus->price = 50;

        $free->stripe_id = $this->createProduct($free->name)->id;
        $premium->stripe_id = $this->createProduct($premium->name)->id;
        $premium_plus->stripe_id = $this->createProduct($premium_plus->name)->id;

        $free->stripe_price_id = $this->createPrice($free->stripe_id, $free->price)->id;
        $premium->stripe_price_id = $this->createPrice($premium->stripe_id, $premium->price)->id;
        $premium_plus->stripe_price_id = $this->createPrice($premium_plus->stripe_id, $premium_plus->price)->id;

        $free->save();
        $premium->save();
        $premium_plus->save();

    }
}
