<?php

namespace Mahi\SpatieTagsNovaFilter;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class SpatieTagsNovaFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'spatie-tags-nova-filter';


    public function __construct($tag_type = null, $withAnyTags = true)
    {
        $this->withMeta([
            "tag_type" => $tag_type,
            "withAnyTags" => $withAnyTags,
        ]);
    }

    public function label($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        if ($value) {
            $tags = collect($value)->map(function ($tag) {
                return $tag['name'];
            });
            if ($this->meta['withAnyTags'])
                $query->withAnyTags($tags, $this->meta['tag_type']);
            else
                $query->withAllTags($tags, $this->meta['tag_type']);
        }
        return $query;
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [];
    }
}