<?php

namespace App\Models;
use Illuminate\Support\Facades\Cache;

class Settings extends BaseModel
{
    protected $table = 'settings';
    //protected $primaryKey = 'skey';

    /**
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function updateCache(){
        $settings = [];
        foreach (Settings::all() as $setting){
            $settings[$setting->skey] = $setting->svalue;
        }
        Cache::forever('settings', $settings);
    }

    /**
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function getCache(){
        $settings = Cache::get('settings');
        if (is_array($settings)) {
            return $settings;
        }else {
            Settings::updateCache();
            return Settings::getCache();
        }
    }
}
