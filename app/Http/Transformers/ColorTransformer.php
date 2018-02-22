<?php

namespace App\Http\Transformers;

use Aic\Hub\Foundation\AbstractTransformer;

class ColorTransformer extends AbstractTransformer
{

    public function transform($color)
    {

        $data = [
            'id' => $color->id,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}
