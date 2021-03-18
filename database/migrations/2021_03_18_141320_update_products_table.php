<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'title_sort',
                'active',
                'sku',
                'image_url',
                'parent_id',
                'priority',
                'price',
                'sale_price',
                'member_price',
                'aic_collection',
                'gift_box',
                'holiday',
                'architecture',
                'glass',
                'category_id',
                'recipient',
                'x_shipping_charge',
                'inventory',
                'choking_hazard',
                'back_order',
                'back_order_due_date',
                'source_created_at',
            ]);
            $table->float('min_compare_at_price')->nullable();
            $table->float('max_compare_at_price')->nullable();
            $table->float('min_current_price')->nullable();
            $table->float('max_current_price')->nullable();
            $table->json('artwork_ids')->nullable();
            $table->json('artist_ids')->nullable();
            $table->json('exhibition_ids')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'min_compare_at_price',
                'max_compare_at_price',
                'min_current_price',
                'max_current_price',
                'artwork_ids',
                'artist_ids',
                'exhibition_ids',
            ]);
            $table->string('title_sort')->nullable();
            $table->boolean('active');
            $table->integer('sku')->nullable();
            $table->string('image_url')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('priority')->nullable();
            $table->float('price')->nullable();
            $table->float('sale_price')->nullable();
            $table->float('member_price')->nullable();
            $table->boolean('aic_collection')->nullable();
            $table->integer('gift_box')->nullable();
            $table->boolean('holiday')->nullable();
            $table->boolean('architecture')->nullable();
            $table->boolean('glass')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('recipient')->nullable();
            $table->integer('x_shipping_charge')->nullable();
            $table->integer('inventory')->nullable();
            $table->boolean('choking_hazard')->nullable();
            $table->boolean('back_order')->nullable();
            $table->date('back_order_due_date')->nullable();
            $table->timestamp('source_created_at')->nullable()->useCurrent();
        });
    }
}
