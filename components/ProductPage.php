<?php namespace Mage2\Cart\Components;

use Cms\Classes\ComponentBase;
use Mage2\Cart\Models\Product;

class ProductPage extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'ProductPage Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'       => 'Product Slug',
                'description' => 'Product Slug',
                'default'     => '{{ :slug }}',
                'type'        => 'string'
            ],
        ];
    }

    public function onRun() {
        $slug = $this->property('slug');
        $product = $this->page['product'] = Product::where('slug','=',$slug)->get()->first();
    }
}