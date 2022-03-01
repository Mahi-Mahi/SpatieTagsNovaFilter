<?php

/**
 * @author Aaron Francis <aarondfrancis@gmail.com|https://twitter.com/aarondfrancis>
 */

namespace Mahi\SpatieTagsNovaFilter;

use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class AutocompleteController
{
    public function tags(Request $request)
    {
        $tags = [];
        if ($request->get('q')) {
            $tags = Tag::containing($request->get('q'))
                ->get()
                ->map(function ($tag) {
                    return ['value' => $tag->id, 'name' => $tag->name];
                })
                ->toArray();
        }

        return $tags;
    }
}
