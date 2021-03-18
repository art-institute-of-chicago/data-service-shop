<?php

namespace App;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Product extends BaseModel
{

    protected $casts = [
        'source_modified_at' => 'date',
        'artwork_ids' => 'array',
        'artist_ids' => 'array',
        'exhibition_ids' => 'array',
    ];
}
