<?php


namespace Context\Shipment;


use Context\Shipment\Entity\Port;
use Context\Shipment\Entity\Ship;
use Context\Shipment\Factory\PortFactory;
use Context\Shipment\Factory\ShipFactory;
use Context\Shipment\Repository\PortRepository;
use Context\Shipment\Repository\ShipRepository;
use Illuminate\Http\Request;

class ShipmentService implements ShipmentContract
{
    public function createShip(Request $request): Ship
    {
        return ShipFactory::create([]); // todo
    }

    public function createPort(Request $request): Port
    {
        return PortFactory::create([]); // todo
    }

    public function createBerthing(int $shipId, Request $request): Ship
    {
        $ship = ShipRepository::get($shipId);
        $ship->berth([]); // todo
        return $ship;
    }

    public function getShip(int $id): Ship
    {
        return ShipRepository::get($id);
    }

    public function loadShips(Request $request): array
    {
        return ShipRepository::load($request);
    }

    public function loadPorts(Request $request): array
    {
        return PortRepository::load($request);
    }
}
