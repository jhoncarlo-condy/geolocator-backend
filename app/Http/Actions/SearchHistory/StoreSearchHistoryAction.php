<?php

namespace App\Http\Actions\SearchHistory;

use App\Models\SearchHistory;

class StoreSearchHistoryAction
{
    public function __invoke($response)
    {
        return SearchHistory::firstOrCreate([
            'user_id' => request()->user()->id,
            'keyword' => $response->keyword
        ]);
    }
}
