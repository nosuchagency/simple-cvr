<?php

namespace App\Providers;

use App\Company;
use App\Services\ElasticSearch;
use App\Setting;
use Illuminate\Support\ServiceProvider;

class ElasticSearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ElasticSearch::class, function ($app) {
            $setting = Setting::query()->first();

            return new ElasticSearch(
                config('elasticsearch.url.initial'),
                config('elasticsearch.url.subsequent'),
                config('elasticsearch.size'),
                Company::$elasticFields,
                [
                    'base_uri' => config('elasticsearch.host'),
                    'auth' => [
                        $setting ? $setting->username : config('elasticsearch.username'),
                        $setting ? $setting->password : config('elasticsearch.password')
                    ],
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json'
                    ]
                ]);
        });
    }
}
