<?php


namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter
{
    protected array $filters = [];

    public function __construct(
        protected Request $request
    ){}

    public function filter(Builder $builder): Builder
    {
        foreach($this->getFilters() as $filter => $value)
        {
            $this->resolveFilter($filter)->filter($builder, $value);
        }
        return $builder;
    }

    protected function getFilters(): array
    {
        return array_filter($this->request->only(array_keys($this->filters)));
    }

    protected function resolveFilter($filter): object
    {
        return new $this->filters[$filter];
    }
}
