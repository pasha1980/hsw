<?php

namespace Context\Shipment;

use Context\Shipment\Entity\Berthing;
use Context\Shipment\Entity\Port;
use Context\Shipment\Entity\Ship;
use Illuminate\Http\Request;

interface ShipmentContract
{
    public function createShip(Request $request): Ship;

    public function createPort(Request $request): Port;

    public function createBerthing(int $shipId, Request $request): Berthing;

    public function updateBerthing(int $id, Request $request): Berthing;

    public function deleteBerthing(int $id): void;

    public function getShip(int $id): Ship;

    public function loadShips(Request $request): array;

    public function loadPorts(Request $request): array;
}
