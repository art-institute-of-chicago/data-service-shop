<?php

namespace App\Http\Transformers;

use Aic\Hub\Foundation\AbstractTransformer;

class ArtistTransformer extends AbstractTransformer
{

    public function transform($artist)
    {

        $data = [
            'id' => $artist->id,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}
