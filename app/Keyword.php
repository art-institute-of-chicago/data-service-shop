<?php

namespace App;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Keyword extends BaseModel
{

    public function fillFrom($source)
    {

        $this->id = $source->keywordId;
        $this->title = $source->keyword;

    }

}
