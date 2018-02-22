<?php

namespace App\Http\Transformers;

use Aic\Hub\Foundation\AbstractTransformer;

class CategoryTransformer extends AbstractTransformer
{

    public function transform($category)
    {

        $data = [
            'id' => $category->id,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}
