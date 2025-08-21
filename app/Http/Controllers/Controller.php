<?php

namespace App\Http\Controllers;

use App\Traits\ResponsiveTrait;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use ResponsiveTrait;
}
