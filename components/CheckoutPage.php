<?php namespace Mage2\Cart\Components;

use Cms\Classes\ComponentBase;

class CheckoutPage extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'CheckoutPage',
            'description' => 'Checkout Page'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
    
    public function onSubmitOrder() {
        $email = post('email_address');
        dd($email);
    }

}