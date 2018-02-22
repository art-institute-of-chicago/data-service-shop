<?php

namespace App\Http\Transformers;

use Aic\Hub\Foundation\AbstractTransformer;

class ProductTransformer extends AbstractTransformer
{

    public function transform($product)
    {

        $data = [
            'id' => $product->id,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}
