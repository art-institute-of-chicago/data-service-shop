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
            'external_sku' => $product->external_sku,
            'min_compare_at_price' => floatval($product->min_compare_at_price),
            'max_compare_at_price' => $product->max_compare_at_price,
            'min_current_price' => $product->min_current_price,
            'max_current_price' => $product->max_current_price,
            'artwork_ids' => array_filter(array_map('floatval', $product->artwork_ids)),
            'artist_ids' => array_filter(array_map('floatval', $product->artist_ids)),
            'exhibition_ids' => array_filter(array_map('floatval', $product->exhibition_ids)),
            'modified_at' => $product->source_modified_at ? $product->source_modified_at->toIso8601String() : null,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}
