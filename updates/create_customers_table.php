<?php namespace Mage2\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateCustomersTable extends Migration
{

    public function up()
    {
        Schema::create('mage2_cart_customers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('password', 60);
            $table->string('phone');
            
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mage2_cart_customers');
    }

}
