<?php

namespace App\http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;

class SeasonsController extends Controller
{
    public function index(Series $series)
    {
        return $series->episodes;
    }
}