<?php namespace Mage2\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('mage2_cart_orders', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('address_shipping_id');
            $table->integer('address_billing_id');
            $table->string('payment_method');
            $table->string('shipping_method');
            $table->integer('status_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mage2_cart_orders');
    }

}
