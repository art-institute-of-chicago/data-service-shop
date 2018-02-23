<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('products', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->integer('parent_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('sku')->nullable();
            $table->integer('external_sku')->nullable();
            $table->string('title')->nullable();
            $table->string('title_sort')->nullable();
            $table->string('image_url')->nullable();
            $table->text('description')->nullable();
            $table->integer('priority')->nullable();
            $table->float('price')->nullable();
            $table->float('sale_price')->nullable();
            $table->float('member_price')->nullable();
            $table->boolean('aic_collection')->nullable();
            $table->integer('gift_box')->nullable();
            $table->string('recipient')->nullable();
            $table->boolean('holiday')->nullable();
            $table->boolean('architecture')->nullable();
            $table->boolean('glass')->nullable();
            $table->integer('x_shipping_charge')->nullable();
            $table->integer('inventory')->nullable();
            $table->boolean('choking_hazard')->nullable();
            $table->boolean('back_order')->nullable();
            $table->date('back_order_due_date')->nullable();
            $table->timestamp('source_created_at')->nullable()->useCurrent();
            $table->timestamp('source_modified_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('facets', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('parent_id');
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->integer('product_id');
            $table->integer('category_id');
        });

        Schema::create('keywords', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('keyword_product', function (Blueprint $table) {
            $table->integer('product_id');
            $table->integer('keyword_id');
        });

        Schema::create('styles', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('product_style', function (Blueprint $table) {
            $table->integer('product_id');
            $table->integer('style_id');
        });

        Schema::create('origins', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('origin_product', function (Blueprint $table) {
            $table->integer('product_id');
            $table->integer('origin_id');
        });

        Schema::create('colors', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('color_product', function (Blueprint $table) {
            $table->integer('product_id');
            $table->integer('color_id');
        });

        Schema::create('stones', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('product_stone', function (Blueprint $table) {
            $table->integer('product_id');
            $table->integer('stone_id');
        });

        Schema::create('artists', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->timestamps();
        });

        Schema::create('artist_product', function (Blueprint $table) {
            $table->integer('product_id');
            $table->integer('artist_id');
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
        Schema::dropIfExists('facets');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('keywords');
        Schema::dropIfExists('keyword_product');
        Schema::dropIfExists('styles');
        Schema::dropIfExists('product_style');
        Schema::dropIfExists('origins');
        Schema::dropIfExists('origin_product');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('color_product');
        Schema::dropIfExists('stones');
        Schema::dropIfExists('product_stone');
        Schema::dropIfExists('artists');
        Schema::dropIfExists('artist_product');
    }
}
