<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function list(Request $request)
    {
        $query = Feed::with('medias');
        if ($request->filled('category')) {
            $category = $request->get('category');
            $query->where('categories', 'LIKE', "%{$category}%");
        }

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        return $query->orderBy('published')->get();
    }
}
