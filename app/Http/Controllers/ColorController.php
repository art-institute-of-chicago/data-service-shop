<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ColorController extends BaseController
{

    protected $model = \App\Color::class;

    protected $transformer = \App\Http\Transformers\ColorTransformer::class;

}
