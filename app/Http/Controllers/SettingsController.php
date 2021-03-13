<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getAllSettings()
    {
        $settings = [];
        foreach (Setting::all() as $setting){
            $settings[$setting->key] = $setting->value;
        }
        return $settings;
    }

    public function updateSettings(UpdateSettingsRequest $request)
    {
        $settings = $request->validated()['settings'];
        foreach ($settings as $key => $value)
        {
            if(!setSettings($key, $value)){
                return respond('Error updating settings', 500);
            }
        }

        return respond('Update successfully');
    }

    public function getContactEmail()
    {
        return settings('website_contact_email');
    }

    public function getAppURLs()
    {
       return settings('app_urls');
    }
}
