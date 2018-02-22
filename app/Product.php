<?php

namespace App;

use Aic\Hub\Foundation\AbstractModel as BaseModel;

class Product extends BaseModel
{

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