<?php

namespace Context\Shipment\Entity;


use Context\Shipment\Factory\ShipFactory;

class Ship
{
    public int $id;

    public string $name;

    public string $imo;

    public ?string $photoLink;

    public ?string $residence;

    public ?Port $residencePort;

    /**
     * @var Berthing[]
     */
    public iterable $birthing;

    public function berth(array $data): Berthing
    {
        $data['ship'] = $this->id;
        return ShipFactory::createBerthing($data);
    }

    public function lastBerthing(): Berthing
    {
        $iterator = new \ArrayIterator($this->birthing);
        $iterator->uasort(function (Berthing $berthing1, Berthing $berthing2) {
            return ($berthing1->end->format('Y-m-d') < $berthing2->end->format('Y-m-d')) ? -1 : 1;
        });

        return array_values(iterator_to_array($iterator))[0];
    }
}
