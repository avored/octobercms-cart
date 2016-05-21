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

    public function formExtendFieldsBefore($form) {
        var_dump($form);die;
        $model = $form->model;
        $addressModel = Address::find($model->address_shipping_id);
        
        return $addressModel->address_1;
        
    }
  

}
