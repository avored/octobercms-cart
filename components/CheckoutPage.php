<?php

namespace Mage2\Cart\Components;

use Illuminate\Support\Facades\Session;
use Cms\Classes\ComponentBase;
use Mage2\Cart\Models\Customer;
use Mage2\Cart\Models\Address;
use Mage2\Cart\Models\Order;
use Exception;
use Illuminate\Support\Facades\Request;
use October\Rain\Support\Facades\Flash;

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
        $data['password_confirmation'] = $data['password'] = str_random(8);
        $customerModel = new Customer();
        
        try {
            if(null == $customerModel->findByEmail($data['email'])) {
                $customer = $customerModel->create($data);
            } else {
                $customer  = $customerModel->findByEmail($data['email']);
            }
            $address = Address::create($data);

            $data ['customer_id'] = $customer->id;
            $data ['address_shipping_id'] = $address->id;
            $data ['address_billing_id'] = $address->id;

            $order = Order::create($data);
            $data = Session::get('items');
            foreach($data as $productId => $item) {
                $order->products()->attach($productId);
            }
            Session::forget('items');
            /*
             * Redirect HERE to Property RedirectPage
             */
        } catch (Exception $ex) {
            if (Request::ajax())
                throw $ex;
            else
                Flash::error($ex->getMessage());
        }


        //redirect to order_success Page
    }

    public function onRun() {
        $data = Session::get('items');
        $this->page['items'] = $data;
    }

}
