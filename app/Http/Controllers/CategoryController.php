<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class CategoryController extends BaseController
{

    protected $model = \App\Category::class;

    protected $transformer = \App\Http\Transformers\CategoryTransformer::class;

}
