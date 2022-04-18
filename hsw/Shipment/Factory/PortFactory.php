<?php


namespace Context\Shipment\Factory;

use App\Models\Port as DBPort;
use Context\Shipment\Entity\Port;
use Context\Shipment\Repository\PortRepository;
use Exception;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class PortFactory
{
    /**
     * [
     *     "name" => "string"
     * ]
     * @param array $data
     * @return Port
     */
    public static function create(array $data): Port
    {
        $dbPort = new DBPort();
        $dbPort->name = $data['name'];

        try {
            $dbPort->save();
        } catch (Exception $exception) {
            throw new UnprocessableEntityHttpException($exception->getMessage());
        }

        return PortRepository::normalize($dbPort);
    }
}
