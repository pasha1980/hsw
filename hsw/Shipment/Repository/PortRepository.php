<?php


namespace Context\Shipment\Repository;


use App\Models\Port as DBPort;
use Context\Shipment\Entity\Port;

class PortRepository
{
    public static function get(int $id): Port
    {
        return self::normalize(DBPort::query()->find($id));
    }

    public static function normalize(DBPort $dbPort): Port
    {
        $port = new Port();
        $port->name = $dbPort->name;
        return $port;
    }
}
