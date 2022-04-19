<?php


namespace Context\Shipment\Repository;


use DateTime;
use Context\Shipment\Entity\Berthing;
use Illuminate\Database\Eloquent\Model as DBBerthing;

class BerthingRepository
{
    public static function get(int $id): Berthing
    {
        return self::normalize(DBBerthing::query()->find($id));
    }

    public static function normalize(DBBerthing $dbBerthing): Berthing
    {
        $berthing = new Berthing();
        $berthing->port = PortRepository::get($dbBerthing->port_id);
        $berthing->start = ($dbBerthing->dateStart instanceof DateTime) ? $dbBerthing->dateStart : new DateTime($dbBerthing->dateStart);;
        $berthing->end = ($dbBerthing->dateEnd instanceof DateTime) ? $dbBerthing->dateEnd : new DateTime($dbBerthing->dateEnd);
        $berthing->fileLink = isset($dbBerthing->file) ? sprintf('https://%s/%s', gethostname(), $dbBerthing->file->path) : null;
        $berthing->cargo = $dbBerthing->cargo;
        $berthing->const = $dbBerthing->const;
        $berthing->isLoading = in_array($dbBerthing->isLoad, [1, true], true);
        $berthing->isUnloading = in_array($dbBerthing->isLoad, [0, false], true);
        $berthing->isShortage = in_array($dbBerthing->isShortage, [1, true], true);
        $berthing->isExcess = in_array($dbBerthing->isShortage, [0, true], true);
        return $berthing;
    }
}
