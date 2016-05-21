<?php
namespace Mage2\Cart\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('mage2_cart_products', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->float('price',11,6);
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('mage2_cart_products');
    }

}
