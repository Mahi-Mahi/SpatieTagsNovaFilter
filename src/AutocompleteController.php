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
            $tagModel = config('tags.tag_model', Tag::class); //https://github.com/spatie/laravel-tags/blob/cd2ee039cac108761e1e92558046a6428f052199/src/HasTags.php#L18

            $tags = $tagModel::containing($request->get('q'))
                ->get()
                ->map(function ($tag) {
                    return ['value' => $tag->id, 'name' => $tag->name];
                })
                ->toArray();
        }

        return $tags;
    }
}
