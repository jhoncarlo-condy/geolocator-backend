<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SearchHistoryResource;
use App\Http\Requests\SearchHistoryFormRequest;
use App\Http\Actions\SearchHistory\StoreSearchHistoryAction;

class SearchHistoryController extends Controller
{
    public function index(SearchHistory $history)
    {
        $per_page = request()->query('per_page') ? request()->query('per_page') : 10;

        $result = $history->simplePaginate($per_page);


        $result->data = SearchHistoryResource::collection($result);

        return response()->json($result);
    }

    public function show(SearchHistory $history)
    {
        return response()->json(new SearchHistoryResource($history));
    }

    public function store(
        SearchHistoryFormRequest $request,
        StoreSearchHistoryAction $action
    )
    {
        return DB::transaction(function () use ($request, $action) {
            $result = ($action)($request);
            return response()->json(new SearchHistoryResource($result));
        });
    }

    public function update() {}

    public function destroy(SearchHistory $history)
    {
        if($history->user_id == Auth::user()->id) {
            $history->delete();
            return response()->json([
                'message' => 'keyword deleted'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'keyword not found'
        ]);
    }
}
