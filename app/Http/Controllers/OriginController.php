<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class OriginController extends BaseController
{

    protected $model = \App\Origin::class;

    protected $transformer = \App\Http\Transformers\OriginTransformer::class;

}
