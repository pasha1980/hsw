<?php


namespace Context\Shipment\Entity;

use DateTime;

class Berthing
{
    public int $id;

    public Port $port;

    public ?DateTime $start;

    public ?DateTime $end;

    public ?string $fileLink;

    public ?string $cargo;

    public ?int $const;

    public bool $isLoading;

    public bool $isUnloading;

    public bool $isShortage;

    public bool $isExcess;

    public ?string $problems;
}
