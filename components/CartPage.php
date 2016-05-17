<?php namespace Mage2\Cart\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Illuminate\Support\Facades\Session;

class CartPage extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'CartPage Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'checkoutPage' => [
                'title' => 'Checkout Page',
                'description' => 'Checkout Page',
                'type' => 'dropdown',
                'default' => 'shop/product',
                'group' => 'Links',
            ],
        ];
    }

    public function onRun() {
        $data = Session::get('items');

        $this->page['checkoutPageUrl'] = $this->getCheckoutPageUrl();

        $this->page['items'] = $data;

    }

    protected function getCheckoutPageUrl() {

        return $this->controller->pageUrl($this->property('checkoutPage'));
    }

    public function getCheckoutPageOptions() {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }
}