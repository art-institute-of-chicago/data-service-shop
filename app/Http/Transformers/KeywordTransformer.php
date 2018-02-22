<?php

namespace App\Http\Transformers;

use Aic\Hub\Foundation\AbstractTransformer;

class KeywordTransformer extends AbstractTransformer
{

    public function transform($keyword)
    {

        $data = [
            'id' => $keyword->id,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}
