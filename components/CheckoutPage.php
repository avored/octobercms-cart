<?php

namespace Mage2\Cart\Components;

use Illuminate\Support\Facades\Session;
use Cms\Classes\ComponentBase;
use Mage2\Cart\Models\Customer;
use Mage2\Cart\Models\Address;

class CheckoutPage extends ComponentBase {

    public function componentDetails() {
        return [
            'name' => 'CheckoutPage',
            'description' => 'Checkout Page'
        ];
    }

    public function defineProperties() {
        return [];
    }

    /*
     * TODO CREATE ORDER ITEM TABLES and INSERT DATA
     * 
     */

    public function onPlaceOrder() {
        $data = post();
        $data['password'] = str_random(8);

        $customer = Customer::create($data);
        $address = Address::create($data);

        $data ['customer_id'] = $customer->id;
        $data ['address_shipping_id'] = $address->id;
        $data ['address_billing_id'] = $address->id;

        $order = Order::create($data);

        //redirect to order_success Page
    }

    public function onRun() {
        $data = Session::get('items');
        $this->page['items'] = $data;
    }

}
