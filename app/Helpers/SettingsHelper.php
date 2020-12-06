<?php

if (!function_exists('settings')) {

    /**
     * description
     *
     * @param string $key
     * @return string
     */
    function settings(string $key) : string
    {
        return \App\Models\Setting::where('key', $key)->first()->pluck('value');
    }
}

if (!function_exists('setSettings')) {

    /**
     * description
     *
     * @param string $key
     * @param string $value
     * @return bool
     */
    function setSettings(string $key, string $value): bool
    {
        try {
            \App\Models\Setting::updateOrCreate(
                ['key'=>$key],
                [
                    'value' => $value
                ]
            );

            return true;
        }catch (Exception $e){
            \Illuminate\Support\Facades\Log::error($e);
            return false;
        }

    }
}
