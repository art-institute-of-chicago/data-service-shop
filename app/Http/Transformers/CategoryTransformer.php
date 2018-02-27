<?php

namespace App\Http\Transformers;

use Aic\Hub\Foundation\AbstractTransformer;

class CategoryTransformer extends AbstractTransformer
{

    public function transform($category)
    {

        $data = [
            'id' => $category->id,
            'parent_id' => $category->parent_id,
            'title' => $category->title,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}
