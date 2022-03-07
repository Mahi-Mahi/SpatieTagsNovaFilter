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
            $query->withAllTags($tags);
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
