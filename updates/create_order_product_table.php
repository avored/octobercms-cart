<?php 
namespace Mage2\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateOrderProductTable extends Migration
{

    public function up()
    {
        Schema::create('mage2_cart_order_product', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('mage2_cart_order_product');
    }

}
