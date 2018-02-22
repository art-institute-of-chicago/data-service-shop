<?php

namespace App;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Product extends BaseModel
{

    public function categories()
    {

        return $this->belongsToMany('App\Category');

    }

    public function colors()
    {

        return $this->belongsToMany('App\Color');

    }

    public function keywords()
    {

        return $this->belongsToMany('App\Keyword');

    }

    public function origins()
    {

        return $this->belongsToMany('App\Origin');

    }

    public function stones()
    {

        return $this->belongsToMany('App\Stone');

    }

    public function styles()
    {

        return $this->belongsToMany('App\Style');

    }

    public function artists()
    {

        return $this->belongsToMany('App\Artist');

    }

    /**
     * Returns web link to the product
     *
     * @return string
     */
    public function getWebUrl()
    {

        return env('PRODUCT_WEB_URL_PREFIX') .$this->id;

    }

}