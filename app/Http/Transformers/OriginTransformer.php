<?php

namespace App\Http\Transformers;

use Aic\Hub\Foundation\AbstractTransformer;

class OriginTransformer extends AbstractTransformer
{

    public function transform($origin)
    {

        $data = [
            'id' => $origin->id,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}
