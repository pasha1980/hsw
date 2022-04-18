<?php


namespace Context\Shipment;


use Context\Shipment\Entity\Port;
use Context\Shipment\Entity\Ship;
use Illuminate\Http\Request;
use Context\Shipment\Repository\ShipRepository;
use Context\Shipment\Factory\ShipFactory;

class ShipmentService implements ShipmentContract
{
    public function __construct(
        private ShipFactory $factory,
        private ShipRepository $repository
    ){}

    public function createShip(Request $request): Ship
    {
        $this->factory->
    }

    public function createPort(Request $request): Port
    {
        // TODO: Implement createPort() method.
    }

    public function createBerthing(int $shipId, Request $request): Ship
    {
        // TODO: Implement createBerthing() method.
    }

    public function getShip(int $id): Ship
    {
        // TODO: Implement getShip() method.
    }

    public function loadShips(Request $request): array
    {
        // TODO: Implement loadShips() method.
    }

    public function loadPorts(Request $request): array
    {
        // TODO: Implement loadPorts() method.
    }
}
