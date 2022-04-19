<?php


namespace Tests\Unit;


use App\Models\Berthing;
use App\Models\File;
use App\Models\Port;
use App\Models\Ship;
use Context\Shipment\Factory\BerthingFactory;
use Context\Shipment\Factory\PortFactory;
use Context\Shipment\Factory\ShipFactory;
use Context\Shipment\Repository\BerthingRepository;
use Context\Shipment\Repository\PortRepository;
use Tests\TestCase;

class ShipmentFactoryTest extends TestCase
{
    public function test_berthing_creation()
    {
        $ship = Ship::factory()->create();
        $port = Port::factory()->create();
        $data = [
            'ship' => $ship->id,
            'port' => $port->id,
            'cargo' => 'test cargo',
            'const' => 3251
        ];

        $berthing = BerthingFactory::create($data);

        $dbBerthing = Berthing::query()->where('cargo', 'test cargo')->first();
        $this->assertModelExists($dbBerthing);
        $this->assertSame($berthing->isExcess, false);
        $this->assertSame($berthing->isUnloading, false);
        $this->assertSame($berthing->isShortage, false);
        $this->assertSame($berthing->isLoading, false);
        $this->assertSame($berthing->cargo, 'test cargo');

        $file = File::factory()->create();
        $data['pdf'] = $file->id;
        $berthing = BerthingFactory::create($data);
        $this->assertSame($berthing->fileLink, sprintf('https://%s/%s', gethostname(), $file->path));
    }

    public function test_ship_creation()
    {
        $port = Port::factory()->create();
        $data = [
            'name' => 'Test ship',
            'imo' => '0000425',
            'residence' => 'UA',
            'residencePort' => $port->id
        ];

        $ship = ShipFactory::create($data);
        $dbShip = Ship::query()->find($ship->id);
        $this->assertModelExists($dbShip);

        $this->assertSame($ship->name, 'Test ship');
        $this->assertSame($ship->imo, '0000425');
        $this->assertSame($ship->residence, 'UA');
        $this->assertTrue($ship->residencePort == PortRepository::normalize($port));

        $file = File::factory()->create();
        $data['photo'] = $file->id;
        $ship = ShipFactory::create($data);
        $this->assertSame($ship->photoLink, sprintf('https://%s/%s', gethostname(), $file->path));
    }

    public function test_port_creation()
    {
        $data = [
            'name' => 'Test port'
        ];
        $port = PortFactory::create($data);
        $dbPort = Port::query()->where('name', $port->name)->first();
        $this->assertModelExists($dbPort);
        $this->assertSame($port->name, 'Test port');
    }

    public function test_berthing_update()
    {
        $berthing = BerthingRepository::normalize(Berthing::factory()->create());
        $updatedBerthing = BerthingFactory::update($berthing->id, [
            'cargo' => 'test cargo'
        ]);

        $this->assertSame($updatedBerthing->cargo, 'test cargo');

        $dbBerthing = Berthing::query()->find($berthing->id);
        $this->assertSame($dbBerthing->cargo, $updatedBerthing->cargo);
    }

    public function test_berthing_delete()
    {
        $berthing = BerthingRepository::normalize(Berthing::factory()->create());
        $dbBerthing = Berthing::query()->find($berthing->id);
        BerthingFactory::delete($berthing->id);
        $this->assertModelMissing($dbBerthing);
    }
}
