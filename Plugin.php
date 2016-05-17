<?php namespace Mage2\Cart;

use Backend;
use System\Classes\PluginBase;

/**
 * Cart Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Cart',
            'description' => 'No description provided yet...',
            'author'      => 'Mage2',
            'icon'        => 'icon-shopping-cart'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        

        return [
            'Mage2\Cart\Components\Products' => 'products',
            'Mage2\Cart\Components\CartPage' => 'cartPage',
            'Mage2\Cart\Components\ProductPage' => 'productPage',
            'Mage2\Cart\Components\Mage2Cart' => 'mage2cart',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'mage2.cart.some_permission' => [
                'tab' => 'Cart',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
       

        return [
            'cart' => [
                'label'       => 'Cart',
                'url'         => Backend::url('mage2/cart/products'),
                'icon'        => 'icon-shopping-cart',
                'permissions' => ['mage2.cart.*'],
                'order'       => 500,
            ],
        ];
    }

}
