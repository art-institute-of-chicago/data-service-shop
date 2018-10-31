<?php

namespace App;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Artist extends BaseModel
{

    public function fillFrom($source)
    {

        $this->id = $source->id;
        $this->first_name = $source->firstName;
        $this->last_name = $source->lastName;

    }

    public function getTitleAttribute()
    {

        return $this->first_name .' ' .$this->last_name;

    }
}
