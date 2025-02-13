<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Services\SearchService;
use Illuminate\Http\Response as HttpResponse;

class SearchController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function search(SearchRequest $request)
    {
        $validated = $request->validated();

        // استفاده از سرویس برای انجام جستجو
        $trips = $this->searchService->performSearch($validated);

        // برگرداندن نتایج به صورت JSON
        return response()->json($trips, HttpResponse::HTTP_OK);
    }
}
