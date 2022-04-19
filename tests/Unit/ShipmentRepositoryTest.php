<?php


namespace Tests\Unit;


use App\Models\Port as DBPort;
use App\Models\Ship;
use Context\Shipment\Entity\Port;
use Context\Shipment\Repository\PortRepository;
use Context\Shipment\Repository\ShipRepository;
use Illuminate\Http\Request;
use Tests\TestCase;

class ShipmentRepositoryTest extends TestCase
{
    public function test_port_repository()
    {
        $dbPort = DBPort::factory()->create();
        $port = PortRepository::get($dbPort->id);
        $this->assertSame($dbPort->name, $port->name);

        $request = new Request();
        $ports = PortRepository::load($request);
        $this->assertTrue(is_array($ports));
        foreach ($ports as $port) {
            $this->assertTrue(get_class($port) === Port::class);
        }
    }

    public function test_ship_repository()
    {
        $dbShip = Ship::factory()->create();
        $ship = ShipRepository::get($dbShip->getAttribute('id'));
        $this->assertSame($dbShip->name, $ship->name);
        $this->assertSame($dbShip->imo, $ship->imo);
        $this->assertSame($dbShip->residence, $ship->residence);

        $residenceDbPort = DBPort::query()->find($dbShip->residence_port);
        $this->assertSame($residenceDbPort->name, $ship->residencePort->name);

        for ($i = 0; $i < 10; $i++) {
            $dbShip = new Ship();
            $dbShip->imo = '123456789';
            $dbShip->name = 'Test ship';
            $dbShip->residence = 'UA';
            $dbShip->residence_port = null;
            $dbShip->save();
        }

        $request = new Request([
            'imo' => '123456789'
        ]);

        $collection = ShipRepository::load($request);
        foreach ($collection as $ship) {
            $this->assertSame($ship->imo, '123456789');
        }
        $this->assertTrue(count($collection) >= 10);
    }
}
