<?php


namespace Context\Shipment;


use Context\Shipment\Entity\Berthing;
use Context\Shipment\Entity\Port;
use Context\Shipment\Entity\Ship;
use Context\Shipment\Factory\BerthingFactory;
use Context\Shipment\Factory\PortFactory;
use Context\Shipment\Factory\ShipFactory;
use Context\Shipment\Repository\PortRepository;
use Context\Shipment\Repository\ShipRepository;
use Illuminate\Http\Request;

class ShipmentService implements ShipmentContract
{
    public function createShip(Request $request): Ship
    {
        $shipData = PayloadService::normalizeShipCreateData($request);
        return ShipFactory::create($shipData);
    }

    public function createPort(Request $request): Port
    {
        $portData = PayloadService::normalizePortCreateData($request);
        return PortFactory::create($portData);
    }

    public function createBerthing(int $shipId, Request $request): Berthing
    {
        $ship = ShipRepository::get($shipId);
        $berthData = PayloadService::normalizeBerthingCreateData($request);
        return $ship->berth($berthData);
    }

    public function updateBerthing(int $id, Request $request): Berthing
    {
        $berthData = PayloadService::normalizeBerthingUpdateData($request);
        return BerthingFactory::update($id, $berthData);
    }

    public function deleteBerthing(int $id): void
    {
        BerthingFactory::delete($id);
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
