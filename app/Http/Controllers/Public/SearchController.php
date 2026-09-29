<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Institution;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim((string) $request->string('q'));

        $careers = collect();
        $institutions = collect();

        if ($query !== '') {
            $careers = Career::with('academicArea')
                ->where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->limit(10)
                ->get();

            $institutions = Institution::where('name', 'like', "%{$query}%")
                ->limit(10)
                ->get();
        }

        return view('search.index', [
            'query' => $query,
            'careers' => $careers,
            'institutions' => $institutions,
        ]);
    }
}
