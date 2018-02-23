<?php

namespace App;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Stone extends BaseModel
{

    public function fillFrom($source)
    {

        $this->id = $source->stoneId;
        $this->title = $source->stone;

    }

}