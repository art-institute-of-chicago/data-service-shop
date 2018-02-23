<?php

namespace App;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Category extends BaseModel
{

    public function parent()
    {

        return $this->hasOne('App\Category', 'parent_id');

    }

    public function fillFrom($source)
    {

        $this->id = $source->id;
        $this->parent_id = $source->parentId;
        $this->title = $source->name;

    }

    public function getTitleDisplayAttribute()
    {

        if ($this->parent)
        {

            return $this->parent->title .' > ' .$this->title;

        }

        return $this->title;
    }
}