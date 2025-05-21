<?php

namespace App\Providers;

use App\Mixins\ResponseFactoryMixin;
use App\Models\V1\Lead;
use App\Observers\LeadObserver;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * @throws \ReflectionException
     */
    public function boot(): void
    {
        ResponseFactory::mixin(new ResponseFactoryMixin());
        Lead::observe(LeadObserver::class);

    }
}
