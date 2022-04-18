<?php


namespace Context\Shipment\Repository;


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
        $berthing->start = $dbBerthing->dateStart;
        $berthing->end = $dbBerthing->dateEnd;
        $berthing->fileLink = isset($dbBerthing->file) ? sprintf('https://%s/%s', gethostname(), $dbBerthing->file->path) : null;
        $berthing->cargo = $dbBerthing->cargo;
        $berthing->const = $dbBerthing->const;
        $berthing->isLoading = $dbBerthing->isLoad === true;
        $berthing->isUnloading = $dbBerthing->isLoad === false;
        $berthing->isShortage = $dbBerthing->isShortage === true;
        $berthing->isExcess = $dbBerthing->isShortage === false;
        return $berthing;
    }
}
