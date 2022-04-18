<?php


namespace Context\Shipment\Repository;


use App\Models\Ship as DBShip;
use App\Models\Berthing as DBBerthing;
use Context\Shipment\Entity\Ship;

class ShipRepository
{
    public static function get(int $id): Ship
    {
        return self::normalize(DBShip::query()->find($id));
    }

    public static function normalize(DBShip $dbShip): Ship
    {
        $ship = new Ship();
        $ship->name = $dbShip->name;
        $ship->id = $dbShip->id;
        $ship->imo = $dbShip->imo;
        $ship->residence = $dbShip->residence;
        $ship->residencePort = PortRepository::get($dbShip->residence_port);
        $ship->photoLink = isset($dbShip->file) ? sprintf('https://%s/%s', gethostname(), $dbShip->file->path) : null;

        $ship->birthing = [];
        $birthing = DBBerthing::query()->whereBelongsTo($dbShip)->getModels();
        foreach ($birthing as $berthing) {
            $ship->birthing[] = BerthingRepository::normalize($berthing);
        }

        return $ship;
    }
}
