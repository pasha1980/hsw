<?php


namespace Context\Shipment\Factory;


use App\Models\File;
use App\Models\Ship as DBShip;
use Context\Shipment\Entity\Ship;
use Context\Shipment\Repository\ShipRepository;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ShipFactory
{

    /**
     * [
     *     "name" => "string",
     *     "imo" => "string",
     *     "residence" => "string",
     *     "residencePort" => 1,
     *     "photo" => 1
     * ]
     * @param array $data
     * @return Ship
     */
    public static function create(array $data): Ship
    {
        $dbShip = new DBShip();
        $dbShip->name = $data['name'];
        $dbShip->imo = $data['imo'];
        $dbShip->residence = $data['residence'] ?? null;
        $dbShip->residence_port = $data['residencePort'] ?? null;
        $dbShip->setFile(File::query()->find($data['photo'] ?? null));

        try {
            $dbShip->save();
        } catch (Exception $exception) {
            throw new UnprocessableEntityHttpException($exception->getMessage());
        }

        return ShipRepository::normalize($dbShip);
    }
}
