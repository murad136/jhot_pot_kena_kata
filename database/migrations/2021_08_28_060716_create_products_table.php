<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categorie_id');
            $table->unsignedBigInteger('subcategorie_id');
            $table->integer('childcategorie_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('pickup_id')->nullable();
            $table->string('name');
            $table->string('code');
            $table->string('product_slug')->nullable();
            $table->string('unit')->nullable();
            $table->string('tags')->nullable();
            $table->string('video')->nullable();
            $table->float('purchage_price',10,2)->nullable();
            $table->float('selling_price',10,2)->nullable();
            $table->float('discount_proce',10,2)->nullable();
            $table->string('sku')->nullable();
            $table->string('warehouse')->nullable();
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('image')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('today_deal')->nullable();
            $table->integer('status')->nullable();
            $table->integer('flash_deal_id')->nullable();
            $table->float('cash_on_delivery',10,2)->nullable();
            $table->integer('admin_id')->nullable();
            $table->timestamps();
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategorie_id')->references('id')->on('subcategories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
