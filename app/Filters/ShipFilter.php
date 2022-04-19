<?php


namespace App\Filters;


use Context\Shipment\Filter\ImoFilter;
use Context\Shipment\Filter\NameFilter;

class ShipFilter extends AbstractFilter
{
    protected array $filters = [
        'imo' => ImoFilter::class,
        'name' => NameFilter::class
    ];
}
