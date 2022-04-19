<?php


namespace Context\Shipment\Filter;


use Illuminate\Database\Eloquent\Builder;

class ImoFilter
{
    public function filter(Builder $builder, string $value): Builder
    {
        return $builder->where('imo', $value);
    }
}
