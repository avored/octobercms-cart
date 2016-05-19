<?php namespace Mage2\Cart\Components;

use Illuminate\Support\Facades\Session;
use Mage2\Cart\Models\Product;
use Cms\Classes\ComponentBase;

class Cart extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'Cart Feature',
            'description' => 'User for add to cart'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
    
    

   

    public function onRun() {
        $data = Session::get('items');
        $this->page['cartItems'] = count($data);
    }
    
     /*
     * 
     * 
     */
    public function onAddToCart() {
        $id = post('id');
        $qty = post('qty');

        $product = Product::findorfail($id);
        $data = Session::get('items');
        
        if(isset($data[$product->id])) {
            $data[$product->id]['qty'] += $qty;  
        } else {
            $data[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => $qty,
            ];
        }
        Session::put('items', $data);
        
        $this->page['cartItems'] = count($data);
    }

}