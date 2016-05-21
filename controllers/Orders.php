<?php

namespace Mage2\Cart\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Mage2\Cart\Models\Address;
/**
 * Orders Back-end Controller
 */
class Orders extends Controller {

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];
    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct() {
        parent::__construct();

        BackendMenu::setContext('Mage2.Cart', 'cart', 'orders');
    }

    public function listOverrideColumnValue($model, $column, $definition) {
        if($column == "shipping_address") {
            $shipppingAddressModel = Address::find($model->address_shipping_id);

            $addressLabel =  $shipppingAddressModel->address_1 .  " , " .
                             $shipppingAddressModel->address_2 .  " , " .
                             $shipppingAddressModel->city .  " " . $shipppingAddressModel->country;

            return $addressLabel;
        }

        if($column == "billing_address") {
            $shipppingAddressModel = Address::find($model->address_shipping_id);

            $addressLabel =  $shipppingAddressModel->address_1 .  " , " .
                $shipppingAddressModel->address_2 .  " , " .
                $shipppingAddressModel->city .  " " . $shipppingAddressModel->country;

            return $addressLabel;
        }
    }

    public function formExtendFieldsBefore($form) {

        $shipppingAddressModel = Address::find($form->model->address_shipping_id);

        $form->model->shipping_address =    $shipppingAddressModel->address_1 .  " , " .
                                                    $shipppingAddressModel->address_2 .  " , " .
                                                    $shipppingAddressModel->city .  " " . $shipppingAddressModel->country;

    }
  

}
