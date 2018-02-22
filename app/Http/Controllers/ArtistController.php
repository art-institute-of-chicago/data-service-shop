<?php

namespace App\Http\Controllers;

use Aic\Hub\Foundation\AbstractController as BaseController;

class ArtistController extends BaseController
{

    protected $model = \App\Artist::class;

    protected $transformer = \App\Http\Transformers\ArtistTransformer::class;

}