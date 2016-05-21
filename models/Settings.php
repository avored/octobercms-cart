<?php 
namespace Mage2\Cart\Models;

use Model;
class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'mage2_cart_setting';
    public $settingsFields = 'fields.yaml';

    public function initSettingsData()
    {
        $this->free_shipping_method = true;
    }

  
}