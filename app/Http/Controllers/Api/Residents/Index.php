<?php

namespace App\Http\Controllers\Api\Residents;

use App\Http\Controllers\Controller;
use App\Models\Resident;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class Index extends Controller
{
    public function __invoke(Request $request): Collection
    {
        return Resident::query()
            ->select('id', 'name', 'nik')
            ->orderBy('name')
            ->when(
                $request->search,
                fn (Builder $query) => $query
                    ->where('name', 'like', "%{$request->search}%")
                    ->orWhere('nik', 'like', "%{$request->search}%")
            )
            ->when(
                $request->exists('selected'),
                fn (Builder $query) => $query->whereIn('id', $request->input('selected', [])),
                fn (Builder $query) => $query->limit(10)
            )
            ->get();
    }
}
