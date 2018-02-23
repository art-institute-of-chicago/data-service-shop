<?php

namespace App\Http\Transformers;

use Aic\Hub\Foundation\AbstractTransformer;

class ArtistTransformer extends AbstractTransformer
{

    public function transform($artist)
    {

        $data = [
            'id' => $artist->id,
            'first_name' => $artist->first_name,
            'last_name' => $artist->last_name,
        ];

        // Enables ?fields= functionality
        return parent::transform($data);

    }

}
