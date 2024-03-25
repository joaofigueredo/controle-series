<?php

namespace App\Providers;

use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\ServiceProvider;

class SeriesRepositoryProviders extends ServiceProvider
{
    public array $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class
    ];
}