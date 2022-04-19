<?php


namespace Context\Shipment\Filter;


use Illuminate\Database\Eloquent\Builder;

class NameFilter
{
    public function filter(Builder $builder, string $value): Builder
    {
        return $builder->where('name', $value);
    }
}
