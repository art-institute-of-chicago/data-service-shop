<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUnusedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
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
}
