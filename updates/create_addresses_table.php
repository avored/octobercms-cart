<?php namespace Mage2\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateAddressesTable extends Migration
{

    public function up()
    {
        Schema::create('mage2_cart_addresses', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('city');
            $table->string('country');
            $table->string('post_code');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mage2_cart_addresses');
    }

}
