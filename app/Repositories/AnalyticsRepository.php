<?php

namespace App\Repositories;

use Analytics;
use Carbon\Carbon;
use Spatie\Analytics\Period;

class AnalyticsRepository
{
    public function getTrafficData()
    {
        $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));

        // Generate the past 7 days
        $dates = collect(range(0, 6))->map(function ($day) {
            return Carbon::now()->subDays($day)->format('Y-m-d');
        })->reverse()->values();

        // Combine dates with the fetched data
        $dataWithDates = $dates->zip($analyticsData->toArray())->map(function ($item) {
            return [
                'date' => $item[0], // Date
                'pageTitle' => $item[1]['pageTitle'] ?? 'N/A', // Page Title
                'visitors' => $item[1]['activeUsers'] ?? 0, // Visitors
                'pageViews' => $item[1]['screenPageViews'] ?? 0 // Page views
            ];
        });

        return $dataWithDates;

    }

    public function getMostVisited()
    {
        return Analytics::fetchMostVisitedPages(Period::days(7));
    }
}
