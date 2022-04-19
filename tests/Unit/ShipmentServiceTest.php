<?php


namespace Tests\Unit;


use App\Models\Berthing;
use App\Models\File;
use App\Models\Port;
use App\Models\Ship;
use Context\Shipment\Repository\BerthingRepository;
use Context\Shipment\Repository\PortRepository;
use Context\Shipment\Repository\ShipRepository;
use Context\Shipment\ShipmentService;
use Illuminate\Http\Request;
use Tests\TestCase;

class ShipmentServiceTest extends TestCase
{
    public function test_get_and_load_methods()
    {
        $shipmentService = $this->getShipmentService();

        $dbShip = Ship::factory()->create();
        $ship = $shipmentService->getShip($dbShip->id);
        $this->assertTrue(ShipRepository::normalize($dbShip) == $ship);

        $request = new Request([
            'name' => 'Test ship'
        ]);
        $shipCollection = $shipmentService->loadShips($request);
        foreach ($shipCollection as $ship) {
            $this->assertSame($ship->name, 'Test ship');
            $this->assertTrue(get_class($ship) === \Context\Shipment\Entity\Ship::class);
        }

        $portCollection = $shipmentService->loadPorts($request);
        foreach ($portCollection as $port) {
            $this->assertTrue(get_class($port) === \Context\Shipment\Entity\Port::class);
        }
    }

    public function test_create_methods()
    {
        $shipmentService = $this->getShipmentService();

        $portName = 'Test port' . random_int(0, 9999);
        $portCreateRequest = new Request(
            [
                'name' => $portName
            ]
        );
        $port = $shipmentService->createPort($portCreateRequest);
        $dbPort = Port::query()->where('name', $portName)->first();
        $this->assertTrue($port == PortRepository::normalize($dbPort));

        $shipCreateRequest = new Request(
            [
                'name' => 'Test ship',
                'imo' => '024042610861',
                'residence' => 'UA',
                'residencePort' => $dbPort->id
            ]
        );
        $ship = $shipmentService->createShip($shipCreateRequest);
        $dbShip = Ship::query()->find($ship->id);
        $this->assertTrue($ship == ShipRepository::normalize($dbShip));

        $file = File::factory()->create();
        $cargo = 'cargo' . random_int(0, 9999);
        $berthingCreateRequest = new Request(
            [
                'port' => $dbPort->id,
                'pdf' => $file->id,
                'start' => '2022-04-20 00:00:00',
                'end' => '2022-04-20 00:00:01',
                'cargo' => $cargo,
                'const' => 3,
                'isLoad' => true
            ]
        );
        $berthing = $shipmentService->createBerthing($dbShip->id, $berthingCreateRequest);
        $dbBerthing = Berthing::query()->where('cargo', $cargo)->first();
        $this->assertTrue($berthing == BerthingRepository::normalize($dbBerthing));
    }

    private function getShipmentService()
    {
        return new ShipmentService();
    }
}
