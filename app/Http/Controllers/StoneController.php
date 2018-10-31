<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class StoneController extends BaseController
{

    protected $model = \App\Stone::class;

    protected $transformer = \App\Http\Transformers\StoneTransformer::class;

}
