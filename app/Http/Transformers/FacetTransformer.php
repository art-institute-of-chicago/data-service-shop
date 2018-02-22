<?php

namespace App\Http\Transformers;

use Aic\Hub\Foundation\AbstractTransformer;

class FacetTransformer extends AbstractTransformer
{

    public function transform($facet)
    {

        $data = [
            'id' => $facet->id,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}
