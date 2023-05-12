<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $settings = [
        'name' => [
            'display_name' => __('App name'),
            'type' => 'string',
            'default' => config('app.name')
        ],
        'description' => [
            'display_name' => __('App description'),
            'type' => 'string',
            'default' => config('app.description')
        ],
        'url' => [
            'display_name' => __('App canonical URL'),
            'type' => 'string',
            'default' => config('app.url')
        ],
        'timezone' => [
            'display_name' => __('Timezone'),
            'type' => 'string',
            'default' => config('app.timezone')
        ],
        'locale' => [
            'display_name' => __('App default locale'),
            'type' => 'string',
            'default' => config('app.locale')
        ],
        'fallback_locale' => [
            'display_name' => __('App fallback locale'),
            'type' => 'string',
            'default' => config('app.fallback_locale')
        ],
    ];

    public function getSetting($name)
    {
        $setting = self::where('name', $name)->first();
        if(empty($setting)){
            $setting_default = $this->settings[$name];
            if($setting_default === NULL){
                $setting = "";
            }else{
                $setting = config($setting_default);
            }
        }else{
            $setting = settype($setting->value, $setting->type);
        }
        return $setting;
    }

}
