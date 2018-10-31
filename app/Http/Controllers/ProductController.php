<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ProductController extends BaseController
{

    protected $model = \App\Product::class;

    protected $transformer = \App\Http\Transformers\ProductTransformer::class;

}
