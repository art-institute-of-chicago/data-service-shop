<?php

namespace App;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Origin extends BaseModel
{

    public function fillFrom($source)
    {

        $this->id = $source->originId;
        $this->title = $source->originName;

    }

}
