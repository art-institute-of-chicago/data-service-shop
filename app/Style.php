<?php

namespace App;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Style extends BaseModel
{

    public function fillFrom($source)
    {

        $this->id = $source->styleId;
        $this->title = $source->artStyle;

    }

}
