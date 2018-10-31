<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class KeywordController extends BaseController
{

    protected $model = \App\Keyword::class;

    protected $transformer = \App\Http\Transformers\KeywordTransformer::class;

}
