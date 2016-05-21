<?php namespace Mage2\Cart\Updates;

use Mage2\Cart\Models\Status;
use Mage2\Cart\Models\Product;
use October\Rain\Database\Updates\Seeder;

class SeedAllTables extends Seeder
{

    public function run()
    {
        Status::create(['identifier' => 'pending', 'name' => 'Pending']);
        Status::create(['identifier' => 'processing', 'name' => 'Processing']);
        Status::create(['identifier' => 'complete', 'name' => 'Complete']);
        
        // JUST FOR DEVELOPMENT PURPOSE
        $price = 10.99;
        for($i =1 ; $i<26; $i++) {
            Product::create([
                'name' => 'Product ' . $i,
                'slug' => 'product-' . $i,
                'price' =>   $price += $i,
                'description' => 'Product ' . $i . " Description",
                
            ]);
        }
        
    }

}
