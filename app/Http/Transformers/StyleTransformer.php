<?php

namespace App\Http\Transformers;

use Aic\Hub\Foundation\AbstractTransformer;

class StyleTransformer extends AbstractTransformer
{

    public function transform($style)
    {

        $data = [
            'id' => $style->id,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}
