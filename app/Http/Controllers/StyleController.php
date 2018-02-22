<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class StyleController extends BaseController
{

    protected $model = \App\Style::class;

    protected $transformer = \App\Http\Transformers\StyleTransformer::class;

}