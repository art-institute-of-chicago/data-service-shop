<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class FacetController extends BaseController
{

    protected $model = \App\Facet::class;

    protected $transformer = \App\Http\Transformers\FacetTransformer::class;

}