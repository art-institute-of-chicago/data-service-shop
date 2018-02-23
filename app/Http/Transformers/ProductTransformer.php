<?php

namespace App\Http\Transformers;

use Aic\Hub\Foundation\AbstractTransformer;

class ProductTransformer extends AbstractTransformer
{

    public function transform($product)
    {

        $data = [
            'id' => $product->id,
            'title' => $product->title,
            'description' => $product->description,
            'web_url' => $product->web_url,
            'sort_title' => $product->title_sort,
            'parent_id' => $product->parent_id,
            'parent_title' => $product->parent->title ?? null,
            'category_id' => $product->category_id,
            'category_title' => $product->category->title_display ?? null,
            'sku' => $product->sku,
            'external_sku' => $product->external_sku,
            'priority' => $product->priority,
            'price' => $product->price,
            'sale_price' => $product->sale_price,
            'member_price' => $product->member_price,
            'aic_collection' => $product->aic_collection,
            'gift_box' => $product->gift_box,
            'recipient' => $product->recipient,
            'holiday' => $product->holiday,
            'achitecture' => $product->architecture,
            'glass' => $product->glass,
            'x_shipping_charge' => $product->x_shipping_charge,
            'inventory' => $product->inventory,
            'choking_hazard' => $product->choking_hazard,
            'back_order' => $product->back_order,
            'back_order_due_date' => $product->back_order_due_date,
            // TODO: Readd sub categories once we get clarity on how to navigate duplicate ID values
            //'sub_category_ids' => $product->subCategories->pluck('id'),
            //'sub_category_titles' => $product->subCategories->pluck('title_display'),
            'color_ids' => $product->colors->pluck('id'),
            'color_titles' => $product->colors->pluck('title'),
            'keyword_ids' => $product->keywords->pluck('id'),
            'keyword_titles' => $product->keywords->pluck('title'),
            'origin_ids' => $product->origins->pluck('id'),
            'origin_titles' => $product->origins->pluck('title'),
            'stone_ids' => $product->stones->pluck('id'),
            'stone_titles' => $product->stones->pluck('title'),
            'style_ids' => $product->styles->pluck('id'),
            'style_titles' => $product->styles->pluck('title'),
            'artist_ids' => $product->artists->pluck('id'),
            'artist_titles' => $product->artists->pluck('title'),
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}
