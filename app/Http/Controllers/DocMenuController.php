<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documentation;

class DocMenuController extends Controller
{
    public function __invoke($version, $page)
    {
        $docs = Documentation::orderBy('category_id')
            ->where('version', $version)
            ->select('id', 'title', 'slug', 'version', 'category_id')
            ->get()
            ->groupBy(function($item) {
                return $item->category->text;
            });

        $docs = $docs->map(function($items, $index) use ($page) {
            return [
                'title'    => $index,
                'items'    => $items->map(function($item) use ($page) { 
                    return [
                        'title'    => $item->title,
                        'href'     => "/{$item->version}/{$item->slug}",
                        'isActive' => $item->slug == $page,
                    ];
                }),
                'isActive' => $items->where('slug', $page)->first() != null
            ];
        });

        return $docs;
    }
}
