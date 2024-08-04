<?php 

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

if (!function_exists('getPageTitle')) {
    function getPageTitle()
    {
        $currentRouteName = Route::currentRouteName();
        $currentRouteName = ucwords(str_replace('.', ' ', $currentRouteName));
        return $currentRouteName;
    }
}

if (!function_exists('getCurrentRoute')) {
    function getCurrentRoute()
    {
        $currentRoute = Route::currentRouteName();
        return $currentRoute;
    }
}

if (!function_exists('urlTree')) {
    function urlTree($delimiter = ' > ')
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
}

if (!function_exists('generateBreadcrumb')) {
    function generateBreadcrumb($request)
    {
        $segments = $request->segments();

        $breadcrumbs = [];

        $urlSoFar = ''; // Initialize an empty string to build the URL iteratively

        // Iterate through the segments to build the breadcrumb hierarchy
        foreach ($segments as $segment) {
            $urlSoFar .= '/' . $segment; // Append the current segment to the URL so far

            // Check if the current segment corresponds to a route name without parameters
            if (Route::has($segment) && !Route::hasParameters($segment)) {
                // Generate a breadcrumb item for the current segment
                $breadcrumbs[] = [
                    'url' => $urlSoFar,
                    'label' => ucfirst($segment), // Use ucfirst to capitalize the segment for label
                ];
            }
        }

        return $breadcrumbs;
    }
}

if (! function_exists('getFirstParagraph')) {
    function getFirstParagraph($content, $limit = 150) {
        $first_paragraph = '';
        $dom = new \DOMDocument();
        @$dom->loadHTML($content);
        $paragraphs = $dom->getElementsByTagName('p');
        if ($paragraphs->length > 0) {
            $first_paragraph = $paragraphs->item(0)->textContent;
        }
        return Str::limit($first_paragraph, $limit, '...');
    }
}