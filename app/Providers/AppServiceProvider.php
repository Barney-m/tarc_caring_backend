<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ConsoleTVs\Charts\Registrar as Charts;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Charts $charts)
    {
        $charts->register([
            \App\Charts\AdminCharts\FeedbackSentimentChart::class,
            \App\Charts\AdminCharts\FeedbackMadeChart::class,
            \App\Charts\AdminCharts\FeedbackResultChart::class,
            \App\Charts\AdminCharts\TotalUserChart::class,
            \App\Charts\AdminCharts\TotalFeedbackChart::class,
            \App\Charts\AdminCharts\PriorityChart::class,
        ]);
    }
}
