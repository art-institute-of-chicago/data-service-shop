<?php

namespace App;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Color extends BaseModel
{

    public function fillFrom($source)
    {

        $this->id = $source->colorId;
        $this->title = $source->color;

    }

}
