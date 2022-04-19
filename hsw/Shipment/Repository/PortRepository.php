<?php


namespace Context\Shipment\Repository;


use App\Models\Port as DBPort;
use Context\Shipment\Entity\Port;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PortRepository
{
    public static function get(?int $id): ?Port
    {
        if ($id !== null) {
            return self::normalize(DBPort::query()->find($id));
        }
        return null;
    }

    /**
     * @param Request $request
     * @return Port[]
     */
    public static function load(Request $request): array
    {
        /** @var Collection $collection */
        $collection = DBPort::filter($request)->get();
        return $collection
            ->map(function (DBPort $port) {
                return self::normalize($port);
            })
            ->toArray()
            ;
    }

    public static function normalize(DBPort $dbPort): Port
    {
        $port = new Port();
        $port->id = $dbPort->id;
        $port->name = $dbPort->name;
        return $port;
    }
}
