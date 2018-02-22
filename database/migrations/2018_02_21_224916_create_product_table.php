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
            $table->string('description')->nullable();
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
            $table->date('back_oder_due_date')->nullable();
            $table->timestamp('source_created_at')->nullable()->useCurrent();
            $table->timestamp('source_indexed_at')->nullable()->useCurrent();
            $table->timestamps();
        });

        Schema::create('facets', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->integer('parent_id')->nullable();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('keywords', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('styles', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('origins', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('colors', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('stones', function (Blueprint $table) {
            $table->integer('id')->unique()->primary();
            $table->string('title')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('artists');
        Schema::dropIfExists('artist_product');
    }
}
