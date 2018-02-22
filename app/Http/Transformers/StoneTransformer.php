<?php

namespace App\Http\Transformers;

use Aic\Hub\Foundation\AbstractTransformer;

class StoneTransformer extends AbstractTransformer
{

    public function transform($stone)
    {

        $data = [
            'id' => $stone->id,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}
