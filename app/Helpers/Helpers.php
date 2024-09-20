<?php

namespace App\Helpers;

use DateTime;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

class Helpers
{
    public static function getPageTitle()
    {
        // Get the current route name
        $currentRouteName = Route::currentRouteName();

        // Remove the word 'index' from the route name if it exists
        $currentRouteName = str_replace('index', '', $currentRouteName);

        // Convert the route name to a readable format
        $currentRouteName = ucwords(str_replace('.', ' ', $currentRouteName));

        // Trim any extra spaces in case 'index' was at the end
        return trim($currentRouteName);
    }

    public static function  getCurrentRoute()
    {
        // Get current Route Name
        $currentRoute = Route::currentRouteName();
        return $currentRoute;
    }

    public static function urlTree($delimiter = ' > ')
    {
        $segments = Request::segments();
        $urlTree = [];

        $url = '';
        foreach ($segments as $i => $segment) {
            $url .= '/' . $segment;
            $urlTree[] = [
                'url' => $url,
                'label' => ucfirst($segment) // You can customize how names are displayed
            ];
        }

        return $urlTree;
    }

    public static function generateBreadcrumb($request)
    {
        $segments = $request->segments();
        $breadcrumbs = [];

        $urlSoFar = ''; // Initialize an empty string to build the URL iteratively

        // Iterate through the segments to build the breadcrumb hierarchy
        foreach ($segments as $segment) {
            $urlSoFar .= '/' . $segment; // Build the URL so far

            // Attempt to resolve the full route by URL to check if it exists
            try {
                $route = app('router')->getRoutes()->match(Request::create($urlSoFar));
            } catch (\Exception $e) {
                $route = null;
            }

            // Ensure that the resolved route is valid and has a name or fallback to the segment name
            if ($route && $route->getName()) {
                // Generate a breadcrumb item for the current segment
                $breadcrumbs[] = [
                    'url' => $urlSoFar,
                    'label' => ucfirst($segment), // Capitalize the segment for label
                ];
            } else {
                // Fallback if the route doesn't have a name or is dynamic
                $breadcrumbs[] = [
                    'url' => $urlSoFar,
                    'label' => ucfirst($segment),
                ];
            }
        }

        return $breadcrumbs;
    }


    public static function convartMonthAndYearToWord($data)
    {
        $monthAndYear = explode('-', $data);

        $month = $monthAndYear[1];
        $dateObj = DateTime::createFromFormat('!m', $month);
        $monthName = $dateObj->format('F');
        $year = $monthAndYear[0];

        return $monthAndYearName = $monthName . " " . $year;
    }
}
